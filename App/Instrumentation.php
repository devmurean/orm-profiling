<?php

namespace App;

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
            $content .= date("Y-m-d H:i:s");
            $content .= $start ? ' [S]' : ' [E]';
            $content .=  ' ' . $filename . ':' . $peakMemoryUsage . PHP_EOL;
            file_put_contents($filePath, $content);
        }
    }
}
