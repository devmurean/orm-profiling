<?php
require __DIR__ . "/vendor/autoload.php";

require "./src/Controllers/CRUDController.php";
app()->group('/(doctrine|eloquent)/user', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'CRUDController@createOperation');
    app()->put('/(\d+)', 'CRUDController@updateOperation');
    app()->delete('/(\d+)', 'CRUDController@deleteOperation');
    app()->get('/', 'CRUDController@readOperation');
    app()->get('/(\d+)', 'CRUDController@lookupOperation');
}]);

require "./src/Controllers/PolymorphicSTController.php";
// Polymorphic ST
app()->group('/(doctrine|eloquent)/st', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicSTController@createOperation');
    app()->put('/(\d+)', 'PolymorphicSTController@updateOperation');
    app()->delete('/(\d+)', 'PolymorphicSTController@deleteOperation');
    app()->get('/', 'PolymorphicSTController@readOperation');
    app()->get('/(\d+)', 'PolymorphicSTController@lookupOperation');
}]);

// Polymorphic TPC
require "./src/Controllers/PolymorphicTPCController.php";
app()->group('/(doctrine|eloquent)/tpc', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicTPCController@createOperation');
    app()->put('/(\d+)', 'PolymorphicTPCController@updateOperation');
    app()->delete('/(\d+)', 'PolymorphicTPCController@deleteOperation');
    app()->get('/', 'PolymorphicTPCController@readOperation');
    app()->get('/(\d+)', 'PolymorphicTPCController@lookupOperation');
}]);

// Polymorphic TPCC
require "./src/Controllers/PolymorphicTPCCController.php";
app()->group('/(doctrine|eloquent)/tpcc', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicTPCCController@createOperation');
    app()->put('/(\d+)', 'PolymorphicTPCCController@updateOperation');
    app()->delete('/(\d+)', 'PolymorphicTPCCController@deleteOperation');
    app()->get('/', 'PolymorphicTPCCController@readOperation');
    app()->get('/(\d+)', 'PolymorphicTPCCController@lookupOperation');
}]);

// Propagation
require "./src/Controllers/ProgationController.php";
app()->post('/', 'ProgationController@invoke');
// Isolation
require "./src/Controllers/IsolationController.php";
app()->post('/', 'IsolationController@invoke');

app()->run();
