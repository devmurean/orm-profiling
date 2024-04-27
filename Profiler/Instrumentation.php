<?php

namespace Profiler;

class Instrumentation
{
  public static function run(callable $callback)
  {
    if ((bool) $_ENV['LOG_MEMORY_USAGE'] === true) {
      return self::LogMemoryUsage($callback);
    }

    return $callback();
  }

  /**
   * @deprecated v2
   *
   * @param boolean $start
   * @param integer $startMemory
   * @return void
   */
  public static function MemoryLog(bool $start = true, int $startMemory = 0)
  {
    if ((bool) $_ENV['LOG_MEMORY_USAGE'] === true) {
      $memoryUsage = memory_get_usage();
      if ($start) {
        return $memoryUsage;
      }

      $method = $_SERVER['REQUEST_METHOD'];
      $uri = $_SERVER['REQUEST_URI'];

      list(, $orm, $group, $action) = explode('/', $uri);

      $filename = 'MEMORY.' . $method . ".{$action}.{$group}.{$orm}";
      $filePath = realpath('.') . '/bin/memory-profiling-result/' . $filename . '.txt';

      if (!file_exists($filePath)) {
        touch($filePath);
      }
      $content = file_get_contents($filePath);
      $content .=  $startMemory . '/' . $memoryUsage . "/{$action}/{$group}/{$orm}" .  PHP_EOL;
      file_put_contents($filePath, $content);
    }
  }

  public static function LogMemoryUsage(callable $callback): mixed
  {
    $memoryUsage = ['start' => 0, 'end' => 0];
    $memoryUsage['start'] = memory_get_usage();
    $result = $callback();
    $memoryUsage['end'] = memory_get_usage();

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    list(, $orm, $group, $action) = explode('/', $uri);

    $filename = 'MEMORY.' . $method . ".{$action}.{$group}.{$orm}";
    $filePath = realpath('.') . '/bin/memory-profiling-result/' . $filename . '.txt';

    if (!file_exists($filePath)) {
      touch($filePath);
    }
    $content = file_get_contents($filePath);
    $content .=  $memoryUsage['start'] . '/' . $memoryUsage['end'] . "/{$action}/{$group}/{$orm}" .  PHP_EOL;
    file_put_contents($filePath, $content);

    return $result;
  }
}
