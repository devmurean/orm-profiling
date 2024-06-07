<?php

namespace Profiler\Input;

use Closure;
use Faker\Factory;
use Faker\Generator;

class AdditionalNullValueInput implements InputInterface
{
  private Generator $faker;

  public function __construct()
  {
    $this->faker = Factory::create();
  }

  public function blueprint(): Closure
  {
    return fn () => [
      'name' => $this->faker->name,
      'address' => $this->faker->address,
      'nik' => rand(10 ** 5, 10 ** 6 - 1),
      'contract_duration' => 1,
    ];
  }
}
