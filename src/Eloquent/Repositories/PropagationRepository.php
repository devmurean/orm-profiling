<?php

namespace App\Eloquent\Repositories;

use Illuminate\Database\Capsule\Manager as DB;

class PropagationRepository extends Repository
{
    private const TABLE = 'user_isolation_propagations';
    public function addAttribute()
    {
        $result = DB::statement(
            'ALTER TABLE ' .
            self::TABLE .
            ' ADD COLUMN IF NOT EXISTS additional_column INT NULL'
        );
        return response()->json(['result' => $result]);
    }
    public function updateAttribute()
    {
        $result = DB::statement(
            'ALTER TABLE ' .
            self::TABLE .
            ' CHANGE COLUMN additional_column new_additional_column INT NULL'
        );
        return response()->json(['result' => $result]);
    }
    public function deleteAttribute()
    {
        $result = DB::statement(
            'ALTER TABLE ' .
            self::TABLE .
            ' DROP COLUMN new_additional_column'
        );
        return response()->json(['result' => $result]);
    }
}
