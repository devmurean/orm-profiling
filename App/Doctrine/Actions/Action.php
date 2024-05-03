<?php

namespace App\Doctrine\Actions;

use Profiler\Instrumentation;

class Action
{
  private Instrumentation $instrumentation;
  public function __construct()
  {
    $isMemoryLogged = (bool) $_ENV['LOG_MEMORY_USAGE'] === true;
    $this->instrumentation = new Instrumentation($isMemoryLogged);
    $this->instrumentation->setUsageAtStart(memory_get_usage());
  }

  public function __destruct()
  {
    $this->instrumentation->setUsageAtEnd(memory_get_usage());
    $this->instrumentation->writeToFile();
  }
}
