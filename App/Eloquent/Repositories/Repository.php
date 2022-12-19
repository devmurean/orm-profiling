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

    protected function randomId(int $min = 1, int $max = 1000): int
    {
        return rand($min, $max);
    }
}
