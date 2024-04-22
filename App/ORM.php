<?php

namespace App;

use App\Interface\ORMDriver;

class ORM
{
  private static function build(string $orm, string $group): ORMDriver
  {
    $group = strtoupper($group);
    $className = "App\\$orm\\Actions\\$group";
    return new $className();
  }

  private static function ucfirstAllArguments(array $arguments): array
  {
    return array_map(fn ($i) => ucfirst($i), $arguments);
  }

  public static function create($orm, $group, $action, $data)
  {
    $args = self::ucfirstAllArguments($orm, $group, $action);
    return self::build(...$args)->create($data);
  }

  public static function read($orm, $group, $action)
  {
    $args = self::ucfirstAllArguments(func_get_args());
    return self::build(...$args)->read();
  }

  public static function update($orm, $group, $action, $id, $data)
  {
    $args = self::ucfirstAllArguments($orm, $group, $action);
    return self::build(...$args)->update($id, $data);
  }

  public static function delete($orm, $group, $action, $id)
  {
    $args = self::ucfirstAllArguments(func_get_args());
    return self::build(...$args)->delete($id);
  }

  public static function lookup($orm, $group, $action, $id)
  {
    $args = self::ucfirstAllArguments(func_get_args());
    return self::build(...$args)->lookup($id);
  }
}
