<?php

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db = getenv('DB_NAME');

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo "Failed to connect to DB" . $conn->connect_error;
}
?>