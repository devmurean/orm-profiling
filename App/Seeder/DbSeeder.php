<?php
namespace App\Seeder;

use Faker\Generator;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class DbSeeder extends Seeder
{
    /** @var Generator */
    private Generator $faker;

    public function run()
    {
        /** @var Generator */
        $this->faker = Factory::create();
        
        
    }

    private function crudSeeder()
    {
        DB::table('user')->
    }
}
