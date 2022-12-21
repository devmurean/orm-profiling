<?php

namespace App\Eloquent\Repositories;

use Illuminate\Database\Capsule\Manager as DB;

class PropagationRepository extends Repository
{
    private const TABLE = 'user_isolation_propagations';

    public function addAttribute()
    {
        $columnName = 'c_' . rand(10**7, 10**8-1);
        $result = DB::statement(
            'ALTER TABLE ' .  self::TABLE .
            ' ADD COLUMN ' . $columnName . ' INT NULL'
        );
        return response()->json(['result' => $result]);
    }
    public function updateAttribute() // update position
    {
        $columns = ['id', 'first_name', 'last_name', 'address', 'email'];
        $selectedColumn = $this->faker->randomElement($columns);

        $result = DB::statement(
            'ALTER TABLE ' . self::TABLE .
            ' CHANGE COLUMN additional_column additional_column' .
            ' INT NULL AFTER `' . $selectedColumn . '`',
        );
        
        return response()->json(['result' => $result]);
    }
    public function deleteAttribute($name)
    {
        $result = DB::statement('ALTER TABLE ' .  self::TABLE .  ' DROP COLUMN ' . $name);
        return response()->json(['result' => $result]);
    }
}
