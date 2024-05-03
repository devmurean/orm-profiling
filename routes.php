<?php

use App\ORM;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::post('/{orm}/{group}/{action}', function ($orm, $group, $action) {
  return ORM::create($orm, $group, $action, $_POST);
});

SimpleRouter::put('/{orm}/{group}/{action}/{id}', function ($orm, $group, $action, $id) {
  return ORM::update($orm, $group, $action, $id, $_POST);
});

SimpleRouter::delete('/{orm}/{group}/{action}/{id}', function ($orm, $group, $action, $id) {
  return ORM::delete($orm, $group, $action, $id);
});

SimpleRouter::get('/{orm}/{group}/{action}', function ($orm, $group, $action) {
  return ORM::read($orm, $group, $action);
});

SimpleRouter::get('/{orm}/{group}/{action}/{id}', function ($orm, $group, $action, $id) {
  return ORM::lookup($orm, $group, $action, $id);
});
