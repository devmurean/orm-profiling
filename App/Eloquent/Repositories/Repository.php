<?php
namespace App\Eloquent\Repositories;

use Faker\Factory;
use Faker\Generator;

require_once 'bootstrap.php';

class Repository
{
    protected Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function __destruct()
    {
        if ((bool) $_ENV['LOG_MEMORY_USAGE'] === true) {
            $filename = $_SERVER['REQUEST_METHOD'] . str_replace('/', '.', $_SERVER['PATH_INFO']);
        
            $peakMemoryUsage = memory_get_peak_usage();
            echo $filePath = realpath('.') . '/bin/memory-profiling-result/'.$filename.'.txt';
            if (!file_exists($filePath)) {
                touch($filePath);
            }
            $content = file_get_contents($filePath);
            $content .= time() . '.' . $filename . ':' . $peakMemoryUsage . PHP_EOL;
            file_put_contents($filePath, $content);
        }
    }

    protected function randomId(int $min = 1, int $max = 1000): int
    {
        return rand($min, $max);
    }
}
