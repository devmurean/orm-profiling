<?php

namespace Profiler\Input;

use Closure;

interface InputInterface
{
  public function blueprint(): Closure;
}
