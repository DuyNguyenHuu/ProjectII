<?php

$host = "localhost";
$database = "nganhangdethi";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli -> connect_error){
    die("Connection error: " . $mysqli-> connect_error);
}

return $mysqli;