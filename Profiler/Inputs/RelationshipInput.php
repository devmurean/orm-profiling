<?php

namespace Profiler\Inputs;

use Closure;
use Faker\Factory;
use Faker\Generator;

class RelationshipInput implements InputInterface
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
      'email' => $this->faker->safeEmail,
    ];
  }
}
