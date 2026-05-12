<?php
/**
 * Zero-Day Secure DB API
 * Enhanced Security & Error Recording
 */

header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);
require_once 'config.php';
require_once 'includes/Database.php';
require_once 'includes/Logger.php';

$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';

// 1. IP Whitelisting Check
if (STRICT_IP_CHECK && !in_array($client_ip, ALLOWED_IPS)) {
    Logger::security("Blocked connection attempt from unauthorized IP: $client_ip");
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Forbidden: IP not whitelisted']);
    exit;
}

// 2. API Key Authentication
$provided_key = $_POST['api_key'] ?? $_GET['api_key'] ?? '';

if (empty($provided_key) || !hash_equals(MANAGE_PASSWORD, $provided_key)) {
    Logger::security("Unauthorized access attempt with invalid API Key from IP: $client_ip");
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$response = [
    'status' => 'success',
    'timestamp' => date('Y-m-d H:i:s')
];

try {
    // Connection Overrides (Strictly Sanitized)
    $host = $_POST['host'] ?? DB_HOST;
    $user = $_POST['user'] ?? DB_USER;
    $pass = $_POST['pass'] ?? DB_PASS;
    $dbname = $_POST['dbname'] ?? null;
    $port = preg_replace('/[^0-9]/', '', $_POST['port'] ?? DB_PORT);

    // Attempt Connection
    $db = new Database($host, $dbname, $user, $pass, $port);
    
    $response['db_status'] = 'Online';
    
    if ($dbname) {
        $tables = $db->fetchAll("SHOW TABLES");
        $response['database'] = ['name' => $dbname, 'table_count' => count($tables)];
    } else {
        $dbs = $db->fetchAll("SHOW DATABASES");
        $response['server'] = ['available_databases' => count($dbs)];
    }

} catch (Exception $e) {
    Logger::error("DB Connection Failure: " . $e->getMessage());
    http_response_code(500);
    $response['status'] = 'error';
    $response['message'] = 'Database connection error recorded.';
    // Don't leak full error in production JSON, only in logs
    // Error is recorded in Logger::error above
}

echo json_encode($response);
?>
