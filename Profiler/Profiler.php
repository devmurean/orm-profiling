<?php

namespace Profiler;

use Profiler\Inputs\InputFactory;

class Profiler
{
  private array $records;
  private array $orms;
  private array $metrics;
  private array $operations;
  private string $host;

  public function __construct(private int|null $n = 1)
  {
    $this->host = $_ENV['HOST'];
    $this->orms = explode(',', $_ENV['ORMS']);
    $this->records = explode(',', $_ENV['RECORD_COUNT']);
    $this->metrics = explode(',', $_ENV['METRICS']);
    $this->operations = explode(',', $_ENV['OPERATIONS']);
  }

  public function run()
  {
    DirectoryManager::checkRequired();
    DirectoryManager::clearOutputDirectory();
    XdebugSetup::turn('on');
    $this->profile();
    XdebugSetup::turn('off');
  }

  /**
   * Profile endpoints within certain group
   *
   * @param string $group Name of group. e.g crud, st, tpc, tpcc, or propagation
   * @param array $data Collection of data that will get impacted in profiling process
   * @return void
   */
  public function profile(): void
  {
    // Metrics
    foreach ($this->metrics as $metric) {
      // ORM
      foreach ($this->orms as $orm) {
        // Number of records
        foreach ($this->records as $numberOfRecords) {
          $metricLabel = strtoupper($metric);
          $ormLabel = strtoupper($orm);
          echo "{$ormLabel}|{$metricLabel}: {$numberOfRecords} records, {$this->n} iteration(s)..." . PHP_EOL;
          // Seeding: Each ORM get fresh record
          (new DatabaseSeeder($orm, $metric, $numberOfRecords))->run();
          // Operations
          foreach ($this->operations as $operation) {
            $operationLabel = strtoupper($operation);
            echo "Profiling {$operationLabel} Operation ";
            $this->ab($numberOfRecords, $orm, $metric, $operation);
            echo '[DONE]' . PHP_EOL;
          }
        }
        echo PHP_EOL;
      }
    }
  }

  /**
   * Build AB command
   *
   * @param integer $record Related record count in database
   * @param string $orm
   * @param string $group
   * @param array $endpoint
   * @param array $data
   * @return void
   */
  private function ab(
    int $record,
    string $orm,
    string $metric,
    string $operation,
  ): void {
    $scriptTimeLimit = $_ENV['APACHE_BENCHMARK_SCRIPT_TIME_LIMIT'];
    $input = new InputFactory();
    for ($iteration = 0; $iteration < $this->n; $iteration++) {
      $isHttpMethodPost = in_array($operation, ['create', 'delete']);
      $isHttpMethodPut = $operation === 'update';
      $isNeedInput = in_array($operation, ['create', 'update', 'delete']);

      $command = "ab -s {$scriptTimeLimit} -n 1 -c 1 ";
      $command .= $isHttpMethodPost ? '-p ' : '';
      $command .= $isHttpMethodPut ? '-u ' : '';

      if ($isNeedInput) {
        $input->build($metric, $operation);
        $command .= "{$input->getFileName()} -T application/json ";
      }

      $command .= "{$this->host}/{$orm}/{$metric}/{$operation}";
      // Add record ID as route parameter
      $id = $iteration + 1;
      $command .= in_array($operation, ['lookup', 'update', 'delete']) ? "/{$id}" : '';

      // Add query param, easier to find result file by number of records
      $command .= "?record={$record}";

      exec($command);
      echo '.';
    }
  }
}
