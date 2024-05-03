<?php

namespace Profiler;

use Pecee\SimpleRouter\SimpleRouter;

class Instrumentation
{
  private array $memoryUsage = ['start' => 0, 'end' => 0];

  public function __construct(private bool $isMemoryLogged = false)
  {
  }
  public function setUsageAtStart(int $usage)
  {
    if ($this->isMemoryLogged) {
      $this->memoryUsage['start'] = $usage;
    }
  }

  public function setUsageAtEnd(int $usage)
  {
    if ($this->isMemoryLogged) {
      $this->memoryUsage['end'] = $usage;
    }
  }

  public function writeToFile()
  {
    if (!$this->isMemoryLogged) {
      return;
    }

    $method = SimpleRouter::request()->getMethod();
    $uri = SimpleRouter::request()->getUrl();

    list(, $orm, $group, $action) = explode('/', $uri);

    $filename = 'MEMORY.' . $method . ".{$action}.{$group}.{$orm}";
    $filePath = realpath('.') . '/memory-profiling-result/' . $filename . '.txt';

    if (!file_exists($filePath)) {
      touch($filePath);
    }
    $content = file_get_contents($filePath);
    $content .= "{$this->memoryUsage['start']}/{$this->memoryUsage['end']}/{$action}/{$group}/{$orm}" .  PHP_EOL;
    file_put_contents($filePath, $content);
  }
}
