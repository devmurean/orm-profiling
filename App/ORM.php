<?php

namespace App;

use App\Interface\ORMDriver;

class ORM
{
  private static function build(string $orm, string $metric): ORMDriver
  {
    $orm = ucfirst($orm);
    $metric = str_replace('-', ' ', $metric);
    $metric = ucwords($metric);
    $metric = str_replace(' ', '', $metric);
    $className = "App\\$orm\\$metric";
    return new $className();
  }

  public static function create($orm, $metric)
  {
    return self::build($orm, $metric)->create();
  }

  public static function read($orm, $metric)
  {
    return self::build($orm, $metric)->read();
  }

  public static function update($orm, $metric, $id)
  {
    return self::build($orm, $metric)->update($id);
  }

  public static function destroy($orm, $metric, $id)
  {
    return self::build($orm, $metric)->destroy($id);
  }

  public static function lookup($orm, $metric, $id)
  {
    return self::build($orm, $metric)->lookup($id);
  }
}
