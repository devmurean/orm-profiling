<?php

namespace App\Interface;

interface ORMDriver
{
  public function create(): mixed;
  public function read(): mixed;
  public function update(int $id): mixed;
  public function destroy(int $id): mixed;
  public function lookup(int $id): mixed;
}
