<?php

// Ligação ao servidor MySQL

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "webdevelop";
$dBName = "cpkaizen_php";

$conn = new mysqli($serverName, $dBUsername, $dBPassword, $dBName);

if ($conn->connect_error) {
    die("A ligação falhou: " . $conn->connect_error);
}
