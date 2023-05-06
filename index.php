<?php

use Dotenv\Dotenv;

require realpath('.') . "/vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "./App/Controllers/CRUDController.php";
app()->group('/(doctrine|eloquent)/user', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'CRUDController@createOperation');
    app()->put('/{id}', 'CRUDController@updateOperation');
    app()->post('/delete/{id}', 'CRUDController@deleteOperation');
    app()->get('/', 'CRUDController@readOperation');
    app()->get('/lookup/{id}', 'CRUDController@lookupOperation');
}]);

require "./App/Controllers/PolymorphicSTController.php";
// Polymorphic ST
app()->group('/(doctrine|eloquent)/st', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicSTController@createOperation');
    app()->put('/', 'PolymorphicSTController@updateOperation');
    app()->post('/delete', 'PolymorphicSTController@deleteOperation');
    app()->get('/', 'PolymorphicSTController@readOperation');
    app()->get('/lookup', 'PolymorphicSTController@lookupOperation');
}]);

// Polymorphic TPC
require "./App/Controllers/PolymorphicTPCController.php";
app()->group('/(doctrine|eloquent)/tpc', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicTPCController@createOperation');
    app()->put('/', 'PolymorphicTPCController@updateOperation');
    app()->post('/delete', 'PolymorphicTPCController@deleteOperation');
    app()->get('/', 'PolymorphicTPCController@readOperation');
    app()->get('/lookup', 'PolymorphicTPCController@lookupOperation');
}]);

// Polymorphic TPCC
require "./App/Controllers/PolymorphicTPCCController.php";
app()->group('/(doctrine|eloquent)/tpcc', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicTPCCController@createOperation');
    app()->put('/', 'PolymorphicTPCCController@updateOperation');
    app()->post('/delete', 'PolymorphicTPCCController@deleteOperation');
    app()->get('/', 'PolymorphicTPCCController@readOperation');
    app()->get('/lookup', 'PolymorphicTPCCController@lookupOperation');
}]);

// Propagation
require "./App/Controllers/PropagationController.php";
app()->post('/(doctrine|eloquent)/propagation/(add|update|delete)', 'App\Controllers\PropagationController@invoke');
// Isolation
require "./App/Controllers/IsolationController.php";
app()->post('/(doctrine|eloquent)/isolation/(add|update|delete)', 'App\Controllers\IsolationController@invoke');

app()->run();
