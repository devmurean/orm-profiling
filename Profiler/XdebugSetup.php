<?php

namespace Profiler;

class XdebugSetup
{
  public static function turn(string $state = 'off')
  {
    $filename = $_ENV['XDEBUG_CONFIG_PATH'];
    // $filename = '/etc/php/8.2/cli/conf.d/20-xdebug.ini';
    $filelines = file($filename);

    $matches  = preg_grep('/^(xdebug.mode|xdebug.output_dir)/', $filelines);

    foreach ($matches as $key => $value) {
      if (str_contains($value, 'xdebug.mode')) {
        $mode = $state !== 'on' ? 'off' : 'profile';
        $filelines[$key] = 'xdebug.mode=' . $mode . PHP_EOL;
      }
      if (str_contains($value, 'xdebug.output_dir')) {
        $dir = realpath(".") . '/' . DirectoryManager::getOutputDirectory();
        $filelines[$key] = 'xdebug.output_dir=' . $dir . PHP_EOL;
      }
    }

    $newContent = implode('', $filelines);
    file_put_contents($filename, $newContent);
    exec('sudo systemctl restart apache2');
  }
}
