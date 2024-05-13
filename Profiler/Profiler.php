<?php

namespace Profiler;

use Closure;
use Faker\Factory;
use Faker\Generator;

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
  private array $records;
  private array $orms;
  private string $host;
  private string $db;
  private string $db_username;
  private string $db_password;
  private int $n = 1;

  public function __construct()
  {
    $this->faker = Factory::create();
    $this->host = $_ENV['HOST'];
    $this->db = $_ENV['DB_NAME'];
    $this->db_username = $_ENV['DB_USER'];
    $this->db_password = $_ENV['DB_PASSWORD'];
    $this->orms = explode(',', $_ENV['ORM']);
    $this->records = explode(',', $_ENV['RECORD_COUNT']);
  }

  public function run()
  {
    $this->manageRequiredDirectories();
    $this->emptyOutputDirectory();
    $this->xdebugSetup(turnoff: false);
    $this->crud();
    $this->st();
    $this->tpc();
    $this->tpcc();
    $this->xdebugSetup(turnoff: true);
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



  private function manageRequiredDirectories()
  {
    echo 'Checking required directories...' . PHP_EOL;
    $directories = ['result', 'inputs'];
    foreach ($directories as $dir) {
      if (!file_exists($dir)) {
        echo "    $dir is not found... CREATING... ";
        $command = "mkdir -m 777 $dir";
        exec($command);
        echo "[DONE]" . PHP_EOL;
      }
    }
    echo PHP_EOL;
  }

  private function emptyOutputDirectory()
  {
    $command = 'rm ' . realpath('.') . '/' . $this->getOutputDirectory() . '/*';
    exec($command);
  }

  private function getOutputDirectory(): string
  {
    return $_ENV['OUTPUT_DIR_NAME'];
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
    $groupLabel = strtoupper($group);
    foreach ($this->records as $record) {
      foreach ($this->orms as $orm) {
        // Each ORM get fresh record
        $this->seeding($orm, $group, $record);
        $this->sentence("Apache Benchmark, {$this->n} iteration(s)");
        foreach ($this->endpoints[$group] as $e) {
          echo strtoupper($e['name']) . ' ';
          $this->buildCommand($record, $orm, $group, $e, $data);
          echo '[DONE]' . PHP_EOL;
        }
        echo PHP_EOL;
      }
      echo "{$groupLabel} Profiling {$record} records... [DONE]" . PHP_EOL . PHP_EOL;
    }
    echo "{$groupLabel} Profiling... [DONE]" . PHP_EOL . PHP_EOL;
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
  private function buildCommand(
    int $record,
    string $orm,
    string $group,
    array $endpoint,
    array $data
  ): void {
    $scriptTimeLimit = $_ENV['APACHE_BENCHMARK_SCRIPT_TIME_LIMIT'];
    for ($iteration = 0; $iteration < $this->n; $iteration++) {
      $inputFileName = $this->prepareInput($orm, $group, $endpoint, $iteration, $data);
      $command = "ab -s {$scriptTimeLimit} -n 1 -c 1 ";
      $command .= $endpoint['method'] === 'post' ? '-p ' : '';
      $command .= $endpoint['method'] === 'put' ? '-u ' : '';
      $command .= in_array($endpoint['method'], ['post', 'put']) ? "{$inputFileName} -T application/json " : '';
      $command .= "{$this->host}/{$orm}{$endpoint['value']}";
      // Add record ID as route parameter
      $id = $iteration + 1;
      $command .= in_array($endpoint['name'], ['lookup', 'update', 'delete']) ? "/{$id}" : '';
      $command .= "?record={$record}";

      exec($command);
      echo '.';
    }
  }

  /**
   * Prepare json file as input for ab testing
   *
   * @param string $orm
   * @param string $group
   * @param array $endpoint
   * @param integer $iteration
   * @param array $data
   * @return string Name of the newly created file
   */
  private function prepareInput(
    string $orm,
    string $group,
    array $endpoint,
    int $iteration,
    array $data
  ): string {
    $inputFileName = "inputs/{$group}.{$orm}.json";
    if (in_array($endpoint['name'], ['update', 'create'])) {
      $data = $group === 'propagation' ? [] : $data[$orm][$iteration];
      $encodedData = json_encode($data);
      $f = fopen($inputFileName, 'w');
      fwrite($f, $encodedData);
      fclose($f);
    }
    return $inputFileName;
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
        $dir = realpath("./{$this->getOutputDirectory()}");
        $filelines[$key] = 'xdebug.output_dir=' . $dir . PHP_EOL;
      }
    }

    $newContent = implode('', $filelines);
    file_put_contents($filename, $newContent);
    exec('sudo systemctl restart apache2');
  }
}
