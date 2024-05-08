<?php
require realpath('.') . "/vendor/autoload.php";

use Pecee\SimpleRouter\SimpleRouter;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

require_once './routes.php';

SimpleRouter::start();
