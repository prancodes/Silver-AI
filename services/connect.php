<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Only load .env file if it exists (useful for local development)
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db   = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];

// Use absolute path for the CA certificate
$ca_cert_path = __DIR__ . '/../certs/cert.pem';

$mysqli = mysqli_init();

// Set SSL using the CA certificate path
mysqli_ssl_set($mysqli, NULL, NULL, $ca_cert_path, NULL, NULL);

// Establish the SSL connection
$mysqli->real_connect($host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);

if ($mysqli->connect_error) {
    die("Failed to connect to DB: " . $mysqli->connect_error);
}

$conn = $mysqli;
?>
