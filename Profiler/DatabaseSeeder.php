<?php

namespace Profiler;

class DatabaseSeeder
{
  private string $db;
  private string $db_username;
  private string $db_password;

  public function __construct(
    private string $orm,
    private string $metric,
    private int $numberOfRecords
  ) {
    $this->db = $_ENV['DB_NAME'];
    $this->db_username = $_ENV['DB_USER'];
    $this->db_password = $_ENV['DB_PASSWORD'];
  }

  public function run(): void
  {
    $dumpFilePath = "./{$this->getDumpFileDir()}/{$this->metric}_{$this->numberOfRecords}.sql";

    echo "Seeding {$this->numberOfRecords} records ({$dumpFilePath})...";

    $this->importSQL($dumpFilePath);
  }

  private function importSQL(string $filePath): void
  {
    // 'mysql -u {username} --password {password} < {filepath}'
    $command = "mysql -u {$this->db_username} --password={$this->db_password} {$this->db} < {$filePath}";
    exec($command);
  }

  private function getDumpFileDir(): string
  {
    return $_ENV['SQL_DUMP_DIR_NAME'];
  }
}
