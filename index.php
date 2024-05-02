<?php
require realpath('.') . "/vendor/autoload.php";

use Dotenv\Dotenv;
use Pecee\SimpleRouter\SimpleRouter;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

require_once './routes.php';

SimpleRouter::start();
