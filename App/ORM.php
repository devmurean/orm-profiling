<?php

namespace App;

use App\Interface\ORMDriver;

class ORM
{
  private static function build(string $orm, string $group): ORMDriver
  {
    $orm = ucfirst($orm);
    $group = strtoupper($group);
    $className = "App\\$orm\\Actions\\$group";
    return new $className();
  }
  // TODO: change route to https://github.com/miladrahimi/phprouter
  public static function create($orm, $group, $action, $data)
  {
    return self::build($orm, $group)->create($data);
  }

  public static function read($orm, $group, $action)
  {
    return self::build($orm, $group)->read();
  }

  public static function update($orm, $group, $action, $id, $data)
  {
    return self::build($orm, $group)->update($id, $data);
  }

  public static function delete($orm, $group, $action, $id)
  {
    return self::build($orm, $group)->delete($id);
  }

  public static function lookup($orm, $group, $action, $id)
  {
    return self::build($orm, $group)->lookup($id);
  }
}
