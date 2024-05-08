<?php

namespace Profiler;

use jc21\CliTable;

class Report
{
  private string $mode;
  private array $reading; // reading result
  private array $dirs = [
    'load' => 'load-profiling-result',
    'memory' => 'memory-profiling-result',
    'xdebug' => 'xdebug-profiling-result'
  ];
  private $cliTable;

  public function __construct(string $mode = 'load')
  {
    $this->mode = $mode;
    $this->cliTable = new CliTable();
  }
  private function standardDeviation(array $arr)
  {
    $variance = 0.0;

    // calculating mean using array_sum() method
    $average = $this->average($arr);

    foreach ($arr as $i) {
      // sum of squares of differences between 
      // all numbers and means.
      $variance += pow(($i - $average), 2);
    }

    return (float)sqrt($variance / count($arr));
  }
  private function standardError(float $SD, array $arr)
  {
    return $SD / sqrt(count($arr));
  }
  private function average(array $arr)
  {
    return array_sum($arr) / count($arr);
  }

  private function getStat(array $arr)
  {
    $SD = $this->standardDeviation($arr);
    $SE = $this->standardError($SD, $arr);
    $mean = $this->average($arr);
    $realMean = $this->average(array_filter($arr, fn ($x) => $x <= $mean + $SD && $x >= $mean - $SD));
    return [
      'me' => $mean,
      'rm' => $realMean, // mean after exclude outlier
      'sd' => $SD,
      'se' => $SE,
    ];
  }
  public function readFiles()
  {
    $dir = $this->dirs[$this->mode];
    $documentList = array_values(array_diff(scandir($dir), array('..', '.')));

    foreach ($documentList as $d) {
      if (str_contains($d, 'cachegrind') || str_contains($d, 'MEMORY')) {
        continue; // ignore when filename prefixed by cachegrind or MEMORY
      }
      $fileLines = file($dir . '/' . $d);
      if (!str_contains($fileLines[0], 'Apache')) {
        continue;
      }

      list($group, $number, $ab, $action) = explode('.', $d); // explode file title by dot (.)
      $matches  = preg_grep('/^(Time per request|Document Path)/', $fileLines);
      $toArray = [];
      foreach ($matches as $line) {
        $separatedLine = explode(':', $line);
        if (array_key_exists(1, $separatedLine)) {
          $toArray[$separatedLine[0]] = trim($separatedLine[1]) ?? '';
        }
      }

      $tpr = explode(' ', $toArray['Time per request']);
      $orm = explode(' ', trim(str_replace('/', ' ', $toArray['Document Path'])))[0];

      /**
       * create => [
       *   crud => [
       *     '100' => [
       *       doctrine => [1.452, n, a, ....],
       *       eloquent => [...],
       *     ],
       *     '1000' => [
       *       doctrine => [1.452, n, a, ....],
       *       eloquent => [...],
       *     ]
       *   ]
       * ]
       */
      $this->reading[$action][$group][$number][$orm][] = $tpr[0];
    }
  }

  public function memoryReport($csv = false)
  {
    echo 'Memory Consumption Report:' . PHP_EOL;
    $dir = $this->dirs[$this->mode];
    $documentList = array_values(array_diff(scandir($dir), array('..', '.')));

    $result = [];
    foreach ($documentList as $d) {
      if (!str_contains($d, 'MEMORY')) {
        continue; // ignore when filename is not prefixed by MEMORY
      }
      $fileLines = file($dir . '/' . $d);
      $i = 0;
      $measurement = [];
      foreach ($fileLines as $fl) {
        if ($i >= 4) {
          continue;
        }
        list($memoryStart, $memoryEnd, $action, $group, $orm) = explode('/', str_replace(PHP_EOL, '', $fl));
        $measurement = [
          'action' => $action,
          'group' => $group,
          'orm' => $orm,
          'count' => 100 * 10 ** $i,
          'memory_start' => number_format($memoryStart / 1024 ** 2, 3, ',', '.'),
          'memory_end' => number_format($memoryEnd / 1024 ** 2, 3, ',', '.'),
          'memory_delta' => number_format(($memoryEnd - $memoryStart) / 1024 ** 2, 3, ',', '.'),
        ];
        $i++;
        $result[] = $measurement;
      }
    }

    echo 'Writting on ' . $this->mode . '.csv' . PHP_EOL;

    $fp = fopen('reports/' . $this->mode . '.csv', 'w');
    fputcsv($fp, ['Action', 'Group', 'ORM', 'Count', 'Start', 'End', 'Diff']); // title or header
    foreach ($result as $fields) {
      fputcsv($fp, $fields);
    }
    fclose($fp);

    echo 'Report has been written on ' . $this->mode . '.csv' . PHP_EOL;

    // Showing on CLI
    $this->cliTable->setChars(array(
      'top'          => '-',
      'top-mid'      => '+',
      'top-left'     => '+',
      'top-right'    => '+',
      'bottom'       => '-',
      'bottom-mid'   => '+',
      'bottom-left'  => '+',
      'bottom-right' => '+',
      'left'         => '|',
      'left-mid'     => '+',
      'mid'          => '-',
      'mid-mid'      => '+',
      'right'        => '|',
      'right-mid'    => '+',
      'middle'       => '| ',
    ));
    $this->cliTable->addField('Action', 'action');
    $this->cliTable->addField('Group', 'group');
    $this->cliTable->addField('ORM', 'orm');
    $this->cliTable->addField('Count', 'count');
    $this->cliTable->addField('Start', 'memory_start');
    $this->cliTable->addField('End', 'memory_end');
    $this->cliTable->addField('Diff', 'memory_delta', color: 'yellow');
    $this->cliTable->injectData($result);
    $this->cliTable->display();
  }

  private function prepareData()
  {
    $data = [];
    foreach ($this->reading as $actionName => $groupNames) {
      $subdata['action'] = $actionName;
      foreach ($groupNames as $groupName => $recordNumbers) {
        $subdata['group'] = $groupName;
        foreach ($recordNumbers as $recordNumber => $ormNames) {
          foreach ($ormNames as $ormName => $values) {
            $subdata[$recordNumber . '.' . $ormName] = number_format($this->getStat($values)['rm'], 3, ',', '.');
          }
        }
        $data[] = $subdata;
      }
    }
    return $data;
  }

  public function exportCSV()
  {
    echo 'Writting on ' . $this->mode . '.csv' . PHP_EOL;
    $data = $this->prepareData();
    $fp = fopen('reports/' . $this->mode . '.csv', 'w');

    // Header
    fputcsv($fp, ['Action', 'Group', 'ORM', '100', '1000', '10000', '100000']);

    foreach ($data as $fields) {
      $doctrineFields = [
        $fields['action'],
        $fields['group'],
        'Doctrine',
        $fields['100.doctrine'],
        $fields['1000.doctrine'],
        $fields['10000.doctrine'],
        $fields['100000.doctrine'],
      ];
      $eloquentFields = [
        $fields['action'],
        $fields['group'],
        'Eloquent',
        $fields['100.eloquent'],
        $fields['1000.eloquent'],
        $fields['10000.eloquent'],
        $fields['100000.eloquent'],
      ];
      fputcsv($fp, $doctrineFields);
      fputcsv($fp, $eloquentFields);
    }
    fclose($fp);

    echo 'Report has been written on ' . $this->mode . '.csv' . PHP_EOL;
  }

  public function displayInTerminal()
  {
    $data = $this->prepareData();

    $this->cliTable->setChars(array(
      'top'          => '-',
      'top-mid'      => '+',
      'top-left'     => '+',
      'top-right'    => '+',
      'bottom'       => '-',
      'bottom-mid'   => '+',
      'bottom-left'  => '+',
      'bottom-right' => '+',
      'left'         => '|',
      'left-mid'     => '+',
      'mid'          => '-',
      'mid-mid'      => '+',
      'right'        => '|',
      'right-mid'    => '+',
      'middle'       => '| ',
    ));

    $this->cliTable->addField('Action', 'action');
    $this->cliTable->addField('Group', 'group');
    $this->cliTable->addField('100 (D)', '100.doctrine', color: 'blue');
    $this->cliTable->addField('100 (E)', '100.eloquent', color: 'red');
    $this->cliTable->addField('1K (D)', '1000.doctrine', color: 'blue');
    $this->cliTable->addField('1K (E)', '1000.eloquent', color: 'red');
    $this->cliTable->addField('10K (D)', '10000.doctrine', color: 'blue');
    $this->cliTable->addField('10K (E)', '10000.eloquent', color: 'red');
    $this->cliTable->addField('100K (D)', '100000.doctrine', color: 'blue');
    $this->cliTable->addField('100K (E)', '100000.eloquent', color: 'red');
    $this->cliTable->injectData($data);
    $this->cliTable->display();
  }

  public function loadReport($csv = false)
  {
    echo 'Time Consumption Report:' . PHP_EOL;
    $this->readFiles();
    $this->exportCSV();
    $this->displayInTerminal();
  }

  public function run()
  {
    if ($this->mode === 'memory') {
      $this->memoryReport();
    } else if ($this->mode === 'xdebug') {
      echo '';
    } else {
      $this->loadReport();
    }
  }
}
