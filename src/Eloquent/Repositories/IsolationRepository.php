<?php

namespace App\Eloquent\Repositories;

use Illuminate\Database\Capsule\Manager as DB;

class IsolationRepository extends Repository
{
    private const DATABASE_NAME = 'test_database';
    public function createDatabase()
    {
        $result = DB::statement('CREATE DATABASE IF NOT EXISTS ' . self::DATABASE_NAME);
        return response()->json(['result' => $result]);
    }
    public function alterDatabaseEncryption(bool $encrypted = false)
    {
        $value = $encrypted ? '"Y"' : '"N"';
        $result = DB::statement('ALTER DATABASE ' .  self::DATABASE_NAME .  ' DEFAULT ENCRYPTION ' . $value);
        return response()->json(['result' => $result]);
    }
    public function deleteDatabase()
    {
        $result = DB::statement('DROP DATABASE IF EXISTS ' .  self::DATABASE_NAME);
        return response()->json(['result' => $result]);
    }
}
