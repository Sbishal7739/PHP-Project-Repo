<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "user_registration";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection faield". $conn->connect_error);
}


?>