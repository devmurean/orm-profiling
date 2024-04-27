<?php
require_once __DIR__ . '/router.php';
require realpath('.') . "/vendor/autoload.php";

use App\ORM;
use Dotenv\Dotenv;
use Profiler\Instrumentation;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

post('/$orm/$group/$action', function ($orm, $group, $action) {
  $args = func_get_args();
  $data = $_POST;
  return Instrumentation::run(fn () => ORM::create(...$args, $data));
});

put('/$orm/$group/$action/$id', function ($orm, $group, $action, $id) {
  $args = func_get_args();
  $data = $_POST;
  return Instrumentation::run(fn () => ORM::update(...$args, $data));
});

delete('/$orm/$group/$action/$id', function ($orm, $group, $action, $id) {
  $args = func_get_args();
  return Instrumentation::run(fn () => ORM::delete(...$args));
});

get('/$orm/$group/$action', function ($orm, $group, $action) {
  $args = func_get_args();
  return Instrumentation::run(fn () => ORM::read(...$args));
});

get('/$orm/$group/$action/$id', function ($orm, $group, $action, $id) {
  $args = func_get_args();
  return Instrumentation::run(fn () => ORM::lookup(...$args));
});
