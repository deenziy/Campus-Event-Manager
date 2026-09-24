<?php
require __DIR__ . '/../vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount(__DIR__ . '/../src/firebase_credentials.json')
    ->withDatabaseUri('https://campus-event-manager-ae4d1-default-rtdb.asia-southeast1.firebasedatabase.app/');

$database = $factory->createDatabase();
?>
