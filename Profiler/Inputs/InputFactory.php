<?php

namespace Profiler\Inputs;

use Closure;
use Profiler\Inputs\InputInterface;

/**
 * Handle Input creation using Faker library
 */
class InputFactory
{
  private string $fileName;
  private string $metric;

  public function getFileName(): string
  {
    return $this->fileName;
  }

  public function build(string $metric): void
  {
    $this->metric = $metric;
    $this->fileName = realpath('.') . "/inputs/{$this->metric}.json";

    $data = $this->blueprint($this->metric)();
    $encodedData = json_encode($data);
    $this->writeToFile($encodedData);
  }

  private function writeToFile(string $string): void
  {
    $f = fopen($this->fileName, 'w');
    fwrite($f, $string);
    fclose($f);
  }

  private function blueprint(string $metric): Closure
  {
    $inputClass = $this->findInputClass($metric);
    return $inputClass->blueprint();
  }

  private function findInputClass(string $metric): InputInterface
  {
    $s = str_replace('-', ' ', $metric);
    $s = ucwords($s);
    $s = str_replace(' ', '', $s);
    $className = "Profiler\\Inputs\\{$s}Input";
    return new $className();
  }
}
