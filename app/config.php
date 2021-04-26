<?php

require './vendor/autoload.php';

$host = 'localhost';
$db_name = 'workflowapp';
$user = 'root';
$password = 'password';

$conn = new mysqli($host, $user, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
$conn->set_charset("utf8");
