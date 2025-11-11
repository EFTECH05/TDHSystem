<?php
$mysqli = new mysqli('localhost', 'u152458561_hrsystemci', 'Sephor@5', 'u152458561_hrsystemci');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
} else {
    echo "Database connection successful!";
}
