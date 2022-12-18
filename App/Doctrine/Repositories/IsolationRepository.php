<?php

namespace App\Doctrine\Repositories;

use Doctrine\ORM\Query\ResultSetMapping;

class IsolationRepository extends Repository
{
    private ResultSetMapping $rsm;
    private const DATABASE_NAME = 'test_database';
    public function __construct()
    {
        parent::__construct();
        $this->rsm = new ResultSetMapping();
    }
    public function createDatabase()
    {
        $result = $this->em->createNativeQuery(
            'CREATE DATABASE IF NOT EXISTS ' . self::DATABASE_NAME,
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
    public function alterDatabaseEncryption(bool $encrypted = false)
    {
        $value = $encrypted ? '"Y"' : '"N"';
        $result = $this->em->createNativeQuery(
            'ALTER DATABASE ' .  self::DATABASE_NAME .  ' DEFAULT ENCRYPTION ' . $value,
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
    public function deleteDatabase()
    {
        $result = $this->em->createNativeQuery(
            'DROP DATABASE IF EXISTS ' .  self::DATABASE_NAME,
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
}
