<?php

namespace App\Eloquent\Repositories;

use App\Instrumentation;

require_once 'bootstrap.php';

class Repository
{
    protected int $startMemory;
    public function __construct()
    {
        $this->startMemory = Instrumentation::MemoryLog(start: true);
    }

    public function __destruct()
    {
        Instrumentation::MemoryLog(start: false, startMemory: $this->startMemory);
    }
}
