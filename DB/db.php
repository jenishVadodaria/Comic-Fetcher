<?php
require __DIR__ . '/../config.php';
//connection variables
$servername = SERVER_NAME;
$username = USERNAME;
$password = PASSWORD;
$dbname = DBNAME;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
