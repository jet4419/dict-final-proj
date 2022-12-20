<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'devjet');
define('DB_PASS', 'password');
define('DB_NAME', 'employees');

// CREATE connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// CHECK connection
if($conn->connect_error) {
  die('Connection Failed ' . $conn->connect_error);
}