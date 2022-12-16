<?php
require __DIR__ . "/vendor/autoload.php";

require "./src/Controllers/CRUDController.php";
app()->group('/(doctrine|eloquent)/user', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'CRUDController@createOperation');
    app()->put('/', 'CRUDController@updateOperation');
    app()->delete('/', 'CRUDController@deleteOperation');
    app()->get('/', 'CRUDController@readOperation');
    app()->get('/lookup', 'CRUDController@lookupOperation');
}]);

require "./src/Controllers/PolymorphicSTController.php";
// Polymorphic ST
app()->group('/(doctrine|eloquent)/st', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicSTController@createOperation');
    app()->put('/', 'PolymorphicSTController@updateOperation');
    app()->delete('/', 'PolymorphicSTController@deleteOperation');
    app()->get('/', 'PolymorphicSTController@readOperation');
    app()->get('/lookup', 'PolymorphicSTController@lookupOperation');
}]);

// Polymorphic TPC
require "./src/Controllers/PolymorphicTPCController.php";
app()->group('/(doctrine|eloquent)/tpc', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicTPCController@createOperation');
    app()->put('/', 'PolymorphicTPCController@updateOperation');
    app()->delete('/', 'PolymorphicTPCController@deleteOperation');
    app()->get('/', 'PolymorphicTPCController@readOperation');
    app()->get('/lookup', 'PolymorphicTPCController@lookupOperation');
}]);

// Polymorphic TPCC
require "./src/Controllers/PolymorphicTPCCController.php";
app()->group('/(doctrine|eloquent)/tpcc', ['namespace' => 'App\Controllers', function () {
    app()->post('/', 'PolymorphicTPCCController@createOperation');
    app()->put('/', 'PolymorphicTPCCController@updateOperation');
    app()->delete('/', 'PolymorphicTPCCController@deleteOperation');
    app()->get('/', 'PolymorphicTPCCController@readOperation');
    app()->get('/lookup', 'PolymorphicTPCCController@lookupOperation');
}]);

// Propagation
require "./src/Controllers/PropagationController.php";
app()->post('/(doctrine|eloquent)/propagation/(add|update|delete)', 'App\Controllers\PropagationController@invoke');
// Isolation
require "./src/Controllers/IsolationController.php";
app()->post('/(doctrine|eloquent)/isolation/(add|update|delete)', 'App\Controllers\IsolationController@invoke');

app()->run();
