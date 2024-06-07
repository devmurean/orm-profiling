<?php

namespace Profiler;

class DirectoryManager
{
  public static function checkRequired()
  {
    echo 'Checking required directories...' . PHP_EOL;
    $directories = [self::getOutputDirectory(), 'inputs'];
    foreach ($directories as $dir) {
      if (!file_exists($dir)) {
        echo "    $dir is not found... CREATING... ";
        $command = "mkdir -m 777 $dir";
        exec($command);
        echo "[DONE]" . PHP_EOL;
      }
    }
    echo PHP_EOL;
  }


  public static function getOutputDirectory(): string
  {
    return $_ENV['OUTPUT_DIR_NAME'];
  }

  public static function clearOutputDirectory()
  {
    $command = 'rm ' . realpath('.') . '/' . self::getOutputDirectory() . '/*';
    exec($command);
  }
}
