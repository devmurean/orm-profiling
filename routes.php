<?php

use App\ORM;
use Pecee\SimpleRouter\SimpleRouter;
use Profiler\Instrumentation;



SimpleRouter::post('/{orm}/{group}/{action}', function ($orm, $group, $action) {
  return Instrumentation::run(fn () => ORM::create('doctrine', $group, $action, $_POST));
});

SimpleRouter::put('/{orm}/{group}/{action}/{id}', function ($orm, $group, $action, $id) {
  return Instrumentation::run(fn () => ORM::update($orm, $group, $action, $id, $_POST));
});

SimpleRouter::delete('/{orm}/{group}/{action}/{id}', function ($orm, $group, $action, $id) {
  return Instrumentation::run(fn () => ORM::delete($orm, $group, $action, $id));
});

SimpleRouter::get('/{orm}/{group}/{action}', function ($orm, $group, $action) {
  return Instrumentation::run(fn () => ORM::read($orm, $group, $action));
});

SimpleRouter::get('/{orm}/{group}/{action}/{id}', function ($orm, $group, $action, $id) {
  return Instrumentation::run(fn () => ORM::lookup($orm, $group, $action, $id));
});
