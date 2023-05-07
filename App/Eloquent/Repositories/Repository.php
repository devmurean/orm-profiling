<?php

namespace App\Eloquent\Repositories;

use App\Instrumentation;

require_once 'bootstrap.php';

class Repository
{
    public function __construct()
    {
        Instrumentation::MemoryLog(start: true);
    }

    public function __destruct()
    {
        Instrumentation::MemoryLog(start: false);
    }
}
