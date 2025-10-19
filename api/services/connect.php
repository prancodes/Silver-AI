<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// Load environment variables
if (file_exists(__DIR__ . '/../../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
}

// Get database credentials from environment variables
$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
$port = $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?? 4000;
$user = $_ENV['DB_USER'] ?? getenv('DB_USER');
$pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS');
$db = $_ENV['DB_NAME'] ?? getenv('DB_NAME');

try {
    // Initialize MySQLi
    $mysqli = mysqli_init();

    // Check if SSL certificate exists for TiDB
    $ca_cert_path = __DIR__ . '/../../certs/cert.pem';

    if (file_exists($ca_cert_path)) {
        // Use SSL connection for TiDB Cloud
        mysqli_ssl_set($mysqli, NULL, NULL, $ca_cert_path, NULL, NULL);
        $connected = $mysqli->real_connect($host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);
    } else {
        // Use regular connection for local TiDB
        $connected = $mysqli->real_connect($host, $user, $pass, $db, $port);
    }

    if (!$connected) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

    // Set charset
    $mysqli->set_charset("utf8mb4");

    // Make connection available globally
    $conn = $mysqli;

} catch (Exception $e) {
    http_response_code(500);
    die("Database connection error: " . $e->getMessage());
}
?>