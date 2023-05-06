<?php

namespace App\Eloquent\Repositories;


require_once 'bootstrap.php';

class Repository
{

    public function __destruct()
    {
        if ((bool) $_ENV['LOG_MEMORY_USAGE'] === true) {
            $filename = $_SERVER['REQUEST_METHOD'] . str_replace('/', '.', $_SERVER['REQUEST_URI']);

            $peakMemoryUsage = memory_get_peak_usage();
            $filePath = realpath('.') . '/bin/memory-profiling-result/' . $filename . '.txt';
            if (!file_exists($filePath)) {
                touch($filePath);
            }
            $content = file_get_contents($filePath);
            $content .= time() . '.' . $filename . ':' . $peakMemoryUsage . PHP_EOL;
            file_put_contents($filePath, $content);
        }
    }
}
