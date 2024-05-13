<?php

namespace App;

use App\Interface\ORMDriver;

class ORM
{
  private static function build(string $orm, string $group): ORMDriver
  {
    $orm = ucfirst($orm);
    $group = strtoupper($group);
    $className = "App\\$orm\\$group";
    return new $className();
  }

  public static function create($orm, $group)
  {
    return self::build($orm, $group)->create();
  }

  public static function read($orm, $group)
  {
    return self::build($orm, $group)->read();
  }

  public static function update($orm, $group, $id)
  {
    return self::build($orm, $group)->update($id);
  }

  public static function destroy($orm, $group, $id)
  {
    return self::build($orm, $group)->destroy($id);
  }

  public static function lookup($orm, $group, $id)
  {
    return self::build($orm, $group)->lookup($id);
  }
}
