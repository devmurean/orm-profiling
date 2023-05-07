<?php

namespace App;

use DateTime;

class Instrumentation
{
    public static function MemoryLog(bool $start = true)
    {
        if ((bool) $_ENV['LOG_MEMORY_USAGE'] === true) {
            $filename = $_SERVER['REQUEST_METHOD'] . str_replace('/', '.', $_SERVER['REQUEST_URI']);

            $peakMemoryUsage = memory_get_usage();
            $filePath = realpath('.') . '/bin/memory-profiling-result/' . $filename . '.txt';
            if (!file_exists($filePath)) {
                touch($filePath);
            }
            $content = file_get_contents($filePath);
            $content .= DateTime::createFromFormat('U', time());
            $content .= $start ? ' START' : ' END';
            $content .=  ' ' . $filename . ':' . $peakMemoryUsage . PHP_EOL;
            file_put_contents($filePath, $content);
        }
    }
}
