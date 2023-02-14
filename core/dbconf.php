<?php

$dbconf = [
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => '',
    'database' => 'heaven',
    'charset' => 'utf8'
];

$db = new mysqli($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['database']) or die("Can\'t connect to DB");

$db->query("set names ".$dbconf['charset']);