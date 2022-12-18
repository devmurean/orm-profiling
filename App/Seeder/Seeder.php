<?php
namespace App\Seeder;

use App\Eloquent\Models\ContractTPC;
use App\Eloquent\Models\PermanentTPC;
use PDO;
use tebazil\dbseeder\FakerConfigurator;
use tebazil\dbseeder\GeneratorConfigurator;
use tebazil\dbseeder\Seeder as TebazilDbseeder;

class Seeder
{
    private TebazilDbseeder $seeder;
    private GeneratorConfigurator $generator;
    private FakerConfigurator $faker;

    public function __construct()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=orm_profiling;charset=UTF8', 'developer', 'developer');
        $this->seeder = new TebazilDbseeder($pdo);
        $this->generator = $this->seeder->getGeneratorConfigurator();
        $this->faker = $this->generator->getFakerConfigurator();
    }
    public function invoke()
    {
        $this->CRUDSeeder();
        // $this->stSeeder();
        // $this->tpcSeeder();
        // $this->tpccSeeder();
        // $this->propagationIsolationSeeder();

        // truncates all the tables specified and fills them
        // with random data using the configuration provided
        $this->seeder->refill();
    }

    private function CRUDSeeder()
    {
        $this->seeder->table('user')->columns([
            'id',
            'name' => $this->faker->name
        ])->rowQuantity(100);

        $this->seeder->table('desk')->columns([
            'id',
            'location' => $this->faker->currencyCode,
            'user_id' => $this->generator->relation('user', 'id') // 1 to 1
        ])->rowQuantity(100);

        $this->seeder->table('task')->columns([
            'id',
            'description' => 'Task Description',
            'user_id' => rand(1, 100) // 1 to many
        ])->rowQuantity(1000);

        $this->seeder->table('role')->columns([
            'id',
            'name' => $this->faker->word
        ])->rowQuantity(10);

        $this->seeder->table('user_role')->columns([ // user & role, many to many
            'user_id' => $this->generator->relation('user', 'id'),
            'role_id' => $this->generator->relation('role', 'id')
        ])->rowQuantity(200);
    }

    private function stSeeder()
    {
        $seeder = [
            'id',
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'nik' => function () { // nik will be null after 500 records
                static $counter = 0;
                $counter++;
                return $counter > 500 ? null : rand(100000, 999999);
            },
            // contract_duration will be filled after 500 records
            'contract_duration' => function () {
                static $counter = 0;
                $counter++;
                return $counter > 500 ? rand(1, 5) : null;
            },
        ];
  
        $this->seeder->table('st_employee')->columns($seeder);
    }

    private function tpcSeeder()
    {
        $this->seeder->table('tpc_employee')->columns([
            'id',
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'type' => function () {
                static $counter = 0;
                $counter++;
                return $counter > 500 ? ContractTPC::class : PermanentTPC::class;
            },
        ])->rowQuantity(1000);

        $this->seeder->table('tpc_permanent')->columns([
            'tpc_employee_id' => function () {
                static $counter = 0;
                $counter++;
                return $counter;
            },
            'nik' => rand(100000, 999999),
        ])->rowQuantity(500);

        $this->seeder->table('tpc_contract')->columns([
            'tpc_employee_id' => function () {
                static $counter = 500;
                $counter++;
                return $counter;
            },
            'contract_duration' => rand(1, 5),
        ])->rowQuantity(500);
    }

    private function tpccSeeder()
    {
        $employeeSeeder = [];
        for ($i=1;$i<=1000;$i++) {
            $employeeSeeder[] = [
                $i,
                $this->faker->name,
                $this->faker->address
            ];
        }
            
        // $permanentSeeder = [];
        // for ($i=0;$i<500;$i++) {
        //     $employee = $employeeSeeder[$i];
        //     $permanentSeeder[] = [
        //         'id' => $employee['id'],
        //         'name' => $employee['name'],
        //         'address' => $employee['address'],
        //         'nik' => rand(100000, 999999)
        //     ];
        // }

        // $contractSeeder = [];
        // for ($i=500;$i<1000;$i++) {
        //     $employee = $employeeSeeder[$i];
        //     $contractSeeder[] = [
        //         'id' => $employee['id'],
        //         'name' => $employee['name'],
        //         'address' => $employee['address'],
        //         'nik' => rand(100000, 999999)
        //     ];
        // }
           

        $this->seeder->table('tpcc_employee')->data($employeeSeeder, ['id', 'name', 'address'])->rowQuantity(1000);
        // $this->seeder->table('tpcc_permanent')->data($permanentSeeder, [])->rowQuantity(500);
        // $this->seeder->table('tpcc_contract')->data($contractSeeder, [])->rowQuantity(500);
    }

    private function propagationIsolationSeeder()
    {
        $this->seeder->table('propagation_isolation_user')->columns([
            'id',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'email' => $this->faker->safeEmail
        ])->rowQuantity(1000);
    }
}
