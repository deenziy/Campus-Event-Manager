<?php
require 'firebase_config.php';

$id = $_GET['id'];
$database->getReference("events/$id")->remove();

header("Location: view_data.php");
exit;
?>
