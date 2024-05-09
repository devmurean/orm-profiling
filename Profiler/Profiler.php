<?php

namespace Profiler;

use Closure;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Dotenv\Dotenv;

class Profiler
{
  /** @var Generator Faker instance */
  private Generator $faker;
  private array $endpoints = [
    // CRUD Group
    'crud' => [
      ['method' => 'get', 'name' => 'read', 'value' => '/crud/read'],
      ['method' => 'get', 'name' => 'lookup', 'value' => '/crud/lookup'],
      ['method' => 'post', 'name' => 'create', 'value' => '/crud/create'],
      ['method' => 'put', 'name' => 'update', 'value' => '/crud/update'],
      ['method' => 'post', 'name' => 'delete', 'value' => '/crud/delete'],
    ],

    // ST Group
    'st' => [
      ['method' => 'get', 'name' => 'read', 'value' => '/st/read'],
      ['method' => 'get', 'name' => 'lookup', 'value' => '/st/lookup'],
      ['method' => 'post', 'name' => 'create', 'value' => '/st/create'],
      ['method' => 'put', 'name' => 'update', 'value' => '/st/update'],
      ['method' => 'post', 'name' => 'delete', 'value' => '/st/delete'],
    ],

    // TPC Group
    'tpc' => [
      ['method' => 'get', 'name' => 'read', 'value' => '/tpc/read'],
      ['method' => 'get', 'name' => 'lookup', 'value' => '/tpc/lookup'],
      ['method' => 'post', 'name' => 'create', 'value' => '/tpc/create'],
      ['method' => 'put', 'name' => 'update', 'value' => '/tpc/update'],
      ['method' => 'post', 'name' => 'delete', 'value' => '/tpc/delete'],
    ],

    // TPCC Group
    'tpcc' => [
      ['method' => 'get', 'name' => 'read', 'value' => '/tpcc/read'],
      ['method' => 'get', 'name' => 'lookup', 'value' => '/tpcc/lookup'],
      ['method' => 'post', 'name' => 'create', 'value' => '/tpcc/create'],
      ['method' => 'put', 'name' => 'update', 'value' => '/tpcc/update'],
      ['method' => 'post', 'name' => 'delete', 'value' => '/tpcc/delete'],
    ],
  ];

  /** @var array Record count in related database table */
  private array $records = [100, 10 ** 3, 10 ** 4, 10 ** 5];

  private array $orms = ['doctrine', 'eloquent'];

  private string $host;
  private string $db;
  private string $db_username;
  private string $db_password;

  public function __construct(

    /** @var int How many iteration a test is done */
    private int $n,
    private bool $xdebug = false,
    private bool $memory = false
  ) {
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__ . '/../.env');
    $this->faker = Factory::create();
    $this->host = $_ENV['HOST'];
    $this->db = $_ENV['DB_NAME'];
    $this->db_username = $_ENV['DB_USER'];
    $this->db_password = $_ENV['DB_PASSWORD'];
    $this->n = $n;
    $this->xdebug = $xdebug;
    $this->memory = $memory;
  }

  public function run()
  {
    $this->checkDirectoryExistence();
    // Turn on xdebug / memory logging when needed
    $this->specialSetupOn();
    $this->crud();
    $this->st();
    $this->tpc();
    $this->tpcc();
  }

  private function seeding(string $orm, string $group, int $recordCount)
  {
    // e.g. preparing database for <<CRUD>> profiling with <<100>> records
    $this->sentence(strtoupper($orm) . '|' . strtoupper($group) . ": Seed $recordCount records");

    $dumpFilePath = './mysql-dump/' . $recordCount . '_' . $group . '.sql';
    $command = "mysql -u {$this->db_username} --password={$this->db_password} {$this->db} < {$dumpFilePath}";
    // $command = 'mysql -u ' . $this->db_username . ' --password=' . $this->db_password . ' ' . $this->db . ' < ' . $dumpFilePath;

    exec($command);
  }

  private function writeToFile(string $target, array $data)
  {
    $data = json_encode($data);
    $f = fopen($target, 'w');
    fwrite($f, $data);
    fclose($f);
  }

  private function checkDirectoryExistence()
  {
    echo 'Checking required directories...';
    $directories = [
      'memory-profiling-result',
      'xdebug-profiling-result',
      'load-profiling-result',
      'inputs',
      'reports'
    ];
    foreach ($directories as $dir) {
      if (!file_exists($dir)) {
        echo PHP_EOL . "    $dir is not found... CREATING... ";
        mkdir($dir);
        echo "[DONE]" . PHP_EOL;
      }
    }
    echo PHP_EOL;
  }

  private function clearOutputFolder()
  {
    $command = 'rm ' . realpath('.') . '/' . $this->getOutputFolder() . '/*';
    exec($command);
  }

  private function getOutputFolder()
  {
    if ($this->memory) {
      return 'memory-profiling-result';
    } elseif ($this->xdebug) {
      return 'xdebug-profiling-result';
    } else {
      return 'load-profiling-result';
    }
  }

  /**
   * Profile endpoints within certain group
   *
   * @param string $group Name of group. e.g crud, st, tpc, tpcc, or propagation
   * @param array $data Collection of data that will get impacted in profiling process
   * @return void
   */
  public function profile(string $group, array $data = []): void
  {
    // $this->clearOutputFolder();

    $groupLabel = strtoupper($group);
    foreach ($this->records as $record) {
      foreach ($this->orms as $orm) {
        // Each ORM get fresh record
        $this->seeding($orm, $group, $record);
        $ormLabel = strtoupper($orm);
        $this->sentence("Apache Benchmark, {$this->n} iteration(s)");
        foreach ($this->endpoints[$group] as $e) {
          echo strtoupper($e['name']) . ' ';
          for ($i = 0; $i < $this->n; $i++) {
            $iterationNumber = $i + 1;
            $inputFileName = "inputs/{$group}.{$orm}.json";
            if (in_array($e['name'], ['update', 'create'])) {
              $dataToWrite = $group === 'propagation' ? [] : $data[$orm][$i];
              $this->writeToFile($inputFileName, $dataToWrite);
            }
            $command = 'ab -n 1 -c 1 ';
            $command .= $e['method'] === 'post' ? '-p ' : '';
            $command .= $e['method'] === 'put' ? '-u ' : '';
            $command .= in_array($e['method'], ['post', 'put']) ? "{$inputFileName} -T application/json " : '';
            $command .= "{$this->host}/{$orm}{$e['value']}";
            // Add record ID as route parameter
            $id = $i + 1;
            $command .= in_array($e['name'], ['lookup', 'update', 'delete']) ? "/{$id}" : '';

            // Nothing to write when profiling memory or using xdebug
            if (!$this->memory && !$this->xdebug) {
              $command .= " > {$this->getOutputFolder()}/{$group}.{$record}.ab.{$e['name']}." . $orm . '-' . $i . ".txt";
            }

            exec($command);
            echo '.';
          }
          echo '[DONE]' . PHP_EOL;
        }
        echo PHP_EOL;
      }

      echo "{$groupLabel} Profiling {$record} records... [DONE]" . PHP_EOL . PHP_EOL;
    }
    echo "{$groupLabel} Profiling... [DONE]" . PHP_EOL . PHP_EOL;
  }

  private function sentence(string $sentence = '')
  {
    echo $sentence . '...' . PHP_EOL;
  }

  /**
   * Collect data based on closure result
   *
   * @param Closure $callback
   * @param integer $n
   * @return array
   */
  private function collectData(Closure $callback): array
  {
    $data = [];
    foreach ($this->orms as $orm) {
      for ($i = 0; $i < $this->n; $i++) {
        $data[$orm][] = $callback();
      }
    }
    return $data;
  }

  public function crud()
  {
    $this->profile('crud', $this->collectData(fn () => [
      'name' => $this->faker->name,
      'email' => $this->faker->uuid() . '@example.com'
    ]));
  }

  public function st()
  {
    $this->profile('st', $this->collectData(fn () => [
      'name' => $this->faker->name,
      'address' => $this->faker->address,
      'nik' => rand(10 ** 5, 10 ** 6 - 1),
      'contract_duration' => 1,
    ]));
  }

  public function tpc()
  {
    $this->profile('tpc', $this->collectData(fn () => [
      'name' => $this->faker->name,
      'address' => $this->faker->address,
      'nik' => rand(10 ** 5, 10 ** 6 - 1),
    ]));
  }

  public function tpcc()
  {
    $this->profile('tpcc', $this->collectData(fn () => [
      'name' => $this->faker->name,
      'address' => $this->faker->address,
      'nik' => rand(10 ** 5, 10 ** 6 - 1),
    ]));
  }

  public function propagation()
  {
    $this->profile('propagation');
  }

  private function xdebugSetup(bool $turnoff = false)
  {
    $filename = $_ENV['XDEBUG_CONFIG_PATH'];
    // $filename = '/etc/php/8.2/cli/conf.d/20-xdebug.ini';
    $filelines = file($filename);

    $matches  = preg_grep('/^(xdebug.mode|xdebug.output_dir)/', $filelines);

    foreach ($matches as $key => $value) {
      if (str_contains($value, 'xdebug.mode')) {
        $mode = $turnoff ? 'off' : 'profile';
        $filelines[$key] = 'xdebug.mode=' . $mode . PHP_EOL;
      }
      if (str_contains($value, 'xdebug.output_dir')) {
        $dir = realpath('./xdebug-profiling-result');
        $filelines[$key] = 'xdebug.output_dir=' . $dir . PHP_EOL;
      }
    }

    $newContent = implode('', $filelines);
    file_put_contents($filename, $newContent);
    exec('sudo systemctl restart apache2');
  }

  private function memoryLoggingSetup(bool $turnoff = false)
  {
    $filename = getcwd() . '/.env';
    $filelines = file($filename);
    $matches  = preg_grep('/^(LOG_MEMORY_USAGE)/', $filelines);

    foreach ($matches as $key => $value) {
      if (str_contains($value, 'LOG_MEMORY_USAGE')) {
        $mode = $turnoff ? 'false' : 'true';
        $filelines[$key] = 'LOG_MEMORY_USAGE=' . $mode . PHP_EOL;
      }
    }

    $newContent = implode('', $filelines);
    file_put_contents($filename, $newContent);
  }

  private function specialSetupOn()
  {
    $this->specialSetupOff();
    if ($this->xdebug) {
      $this->xdebugSetup();
    }

    if ($this->memory) {
      $this->memoryLoggingSetup();
    }
  }

  private function specialSetupOff()
  {
    $this->xdebugSetup(turnoff: true);
    $this->memoryLoggingSetup(turnoff: true);
  }
}
