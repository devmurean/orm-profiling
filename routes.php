<?php

use App\ORM;
use Pecee\SimpleRouter\SimpleRouter;

// {orm}
SimpleRouter::post('/{orm}/{group}/create', function ($orm, $group) {
  return ORM::create($orm, $group);
});

SimpleRouter::put('/{orm}/{group}/update/{id}', function ($orm, $group, $id) {
  return ORM::update($orm, $group, $id);
});

SimpleRouter::get('/{orm}/{group}/read', function ($orm, $group) {
  return ORM::read($orm, $group);
});

SimpleRouter::get('/{orm}/{group}/lookup/{id}', function ($orm, $group, $id) {
  return ORM::lookup($orm, $group, $id);
});

SimpleRouter::post('/{orm}/{group}/delete/{id}', function ($orm, $group, $id) {
  return ORM::destroy($orm, $group, $id);
});
