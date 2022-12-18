<?php

namespace App\Doctrine\Repositories;

use Doctrine\ORM\Query\ResultSetMapping;

class PropagationRepository extends Repository
{
    private const TABLE = 'user_isolation_propagations';
    private ResultSetMapping $rsm;
    public function __construct()
    {
        parent::__construct();
        $this->rsm = new ResultSetMapping();
    }

    public function addAttribute()
    {
        $result = $this->em->createNativeQuery(
            'ALTER TABLE ' .
            self::TABLE .
            ' ADD COLUMN additional_column INT NULL',
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
    public function updateAttribute()
    {
        $result = $this->em->createNativeQuery(
            'ALTER TABLE ' .
            self::TABLE .
            ' CHANGE COLUMN additional_column new_additional_column INT NULL',
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
    public function deleteAttribute()
    {
        $result = $this->em->createNativeQuery(
            'ALTER TABLE ' .
            self::TABLE .
            ' DROP COLUMN new_additional_column',
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
}
