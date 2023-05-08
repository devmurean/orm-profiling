<?php

namespace App\Eloquent\Repositories;

use Illuminate\Database\Capsule\Manager as DB;

class PropagationRepository extends Repository
{
    private const TABLE = 'user_isolation_propagations';

    public function addAttribute($columnName)
    {
        $query = 'ALTER TABLE ' .  self::TABLE .  ' ADD COLUMN ' . $columnName . ' INT NULL';
        app()->logger()->debug('eloquent ' . $query);
        $result = DB::statement($query);
        return response()->json(['result' => $result]);
    }
    public function updateAttribute() // update position
    {
        $columns = ['id', 'first_name', 'last_name', 'email'];
        $selectedColumn = $columns[array_rand($columns)];

        $result = DB::statement(
            'ALTER TABLE ' . self::TABLE .
                ' CHANGE COLUMN address address' .
                ' TEXT NULL AFTER `' . $selectedColumn . '`',
        );

        return response()->json(['result' => $result]);
    }
    public function deleteAttribute($name)
    {
        $result = DB::statement('ALTER TABLE ' .  self::TABLE .  ' DROP COLUMN ' . $name);
        return response()->json(['result' => $result]);
    }
}
