<?php

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../app/init.php';

$app = new App();