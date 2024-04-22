<?php

namespace App\Interface;

interface ORMDriver
{
  public function create(array $data): mixed;
  public function read(): mixed;
  public function update(int $id, array $data): mixed;
  public function delete(int $id): mixed;
  public function lookup(int $id): mixed;
}
