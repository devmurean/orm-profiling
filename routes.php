<?php

use App\ORM;
use Pecee\SimpleRouter\SimpleRouter;

// Doctrine
SimpleRouter::post('/doctrine/{group}/create', function ($group) {
  return ORM::create('doctrine', $group);
});

SimpleRouter::put('/doctrine/{group}/update/{id}', function ($group, $id) {
  return ORM::update('doctrine', $group, $id);
});

SimpleRouter::get('/doctrine/{group}/read', function ($group) {
  return ORM::read('doctrine', $group);
});

SimpleRouter::get('/doctrine/{group}/lookup/{id}', function ($group, $id) {
  return ORM::lookup('doctrine', $group, $id);
});

SimpleRouter::delete('/doctrine/{group}/delete/{id}', function ($group, $id) {
  return ORM::destroy('doctrine', $group, $id);
});

//  Eloquent 
SimpleRouter::post('/eloquent/{group}/create', function ($group) {
  return ORM::create('eloquent', $group);
});

SimpleRouter::put('/eloquent/{group}/update/{id}', function ($group, $id) {
  return ORM::update('eloquent', $group, $id);
});

SimpleRouter::delete('/eloquent/{group}/delete/{id}', function ($group, $id) {
  return ORM::destroy('eloquent', $group, $id);
});

SimpleRouter::get('/eloquent/{group}/read', function ($group) {
  return ORM::read('eloquent', $group);
});

SimpleRouter::get('/eloquent/{group}/lookup/{id}', function ($group, $id) {
  return ORM::lookup('eloquent', $group, $id);
});
