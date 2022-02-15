<?php

require_once './vendor/oc/rac/Application.php';
require_once './vendor/autoload.php';

$app = new \Maxilana\RAC\Application("PHP_APP_CONFIG");

$app->runTestMode();
