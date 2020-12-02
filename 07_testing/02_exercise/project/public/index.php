<?php

// Error reporting

error_reporting(-1);
ini_set("display_errors", "On");

// Autoload

require ("../vendor/autoload.php");

// Session

session_start();

// Setup directory config

Config\Directory::set("../");
Log::init();

// App example

$app = new App();
$app->run();
