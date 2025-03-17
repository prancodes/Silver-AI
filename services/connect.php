<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db   = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];

// Get CA certificate path from env variable
$ca_cert_path = '../certs/cert.pem';

$mysqli = mysqli_init();
// Set SSL using the CA certificate path
mysqli_ssl_set($mysqli, NULL, NULL, $ca_cert_path, NULL, NULL);

$mysqli->real_connect($host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);
if ($mysqli->connect_error) {
    die("Failed to connect to DB: " . $mysqli->connect_error);
}

$conn = $mysqli;
?>
