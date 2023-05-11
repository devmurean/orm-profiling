<?php

use Dotenv\Dotenv;
use Leaf\Config;

require realpath('.') . "/vendor/autoload.php";

Config::set([
    'log.enabled' => true,
    'log.dir' => __DIR__ . '/logs/'
]);
$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

require "./App/Controllers/CRUDController.php";
app()->group('/(doctrine|eloquent)/crud', ['namespace' => 'App\Controllers', function () {
    app()->post('/create', 'CRUDController@createOperation');
    app()->put('/update/{id}', 'CRUDController@updateOperation');
    app()->post('/delete/{id}', 'CRUDController@deleteOperation');
    app()->get('/read', 'CRUDController@readOperation');
    app()->get('/lookup/{id}', 'CRUDController@lookupOperation');
}]);

require "./App/Controllers/PolymorphicSTController.php";
// Polymorphic ST
app()->group('/(doctrine|eloquent)/st', ['namespace' => 'App\Controllers', function () {
    app()->post('/create', 'PolymorphicSTController@createOperation');
    app()->put('/update/{id}', 'PolymorphicSTController@updateOperation');
    app()->post('/delete/{id}', 'PolymorphicSTController@deleteOperation');
    app()->get('/read', 'PolymorphicSTController@readOperation');
    app()->get('/lookup/{id}', 'PolymorphicSTController@lookupOperation');
}]);

// Polymorphic TPC
require "./App/Controllers/PolymorphicTPCController.php";
app()->group('/(doctrine|eloquent)/tpc', ['namespace' => 'App\Controllers', function () {
    app()->post('/create', 'PolymorphicTPCController@createOperation');
    app()->put('/update/{id}', 'PolymorphicTPCController@updateOperation');
    app()->post('/delete/{id}', 'PolymorphicTPCController@deleteOperation');
    app()->get('/read', 'PolymorphicTPCController@readOperation');
    app()->get('/lookup/{id}', 'PolymorphicTPCController@lookupOperation');
}]);

// Polymorphic TPCC
require "./App/Controllers/PolymorphicTPCCController.php";
app()->group('/(doctrine|eloquent)/tpcc', ['namespace' => 'App\Controllers', function () {
    app()->post('/create', 'PolymorphicTPCCController@createOperation');
    app()->put('/update/{id}', 'PolymorphicTPCCController@updateOperation');
    app()->post('/delete/{id}', 'PolymorphicTPCCController@deleteOperation');
    app()->get('/read', 'PolymorphicTPCCController@readOperation');
    app()->get('/lookup/{id}', 'PolymorphicTPCCController@lookupOperation');
}]);

// Propagation
require "./App/Controllers/PropagationController.php";
app()->post('/(doctrine|eloquent)/propagation/{action}', 'App\Controllers\PropagationController@invoke');
// Isolation
// require "./App/Controllers/IsolationController.php";
// app()->post('/(doctrine|eloquent)/isolation/(add|update|delete)', 'App\Controllers\IsolationController@invoke');

app()->run();
