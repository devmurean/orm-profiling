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
            'ALTER TABLE ' .  self::TABLE .
            ' ADD COLUMN ' . $this->faker->uuid . ' INT NULL',
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
    public function updateAttribute() // update position
    {
        $columns = ['id', 'first_name', 'last_name', 'address', 'email'];
        $selectedColumn = $this->faker->randomElement($columns);

        $result = $this->em->createNativeQuery(
            'ALTER TABLE ' . self::TABLE .
            ' CHANGE COLUMN additional_column additional_column' .
            ' INT NULL AFTER `' . $selectedColumn . '`',
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
    public function deleteAttribute($name)
    {
        $result = $this->em->createNativeQuery(
            'ALTER TABLE ' .  self::TABLE .  ' DROP COLUMN ' . $name,
            $this->rsm
        );
        $result = $result->execute();
        return response()->json(['result' => $result]);
    }
}
