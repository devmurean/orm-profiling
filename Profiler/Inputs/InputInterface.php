<?php

namespace Profiler\Inputs;

use Closure;

interface InputInterface
{
  public function blueprint(): Closure;
}
