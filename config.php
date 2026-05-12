<?php
/**
 * Database Configuration
 */

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306'); 
define('DB_USER', 'TEST1_');
define('DB_PASS', 'TEST1_');
define('DB_PREFIX', 'TEST1_'); // Added prefix here
define('DB_CHARSET', 'utf8mb4');

// Management Password for the Dashboard
define('MANAGE_PASSWORD', 'Zd7#vX9!K2_Lp4$nQ8*R1wM5_ZeroDay'); 

// Security Settings
define('ALLOWED_IPS', ['127.0.0.1', '::1']); // Add your authorized IPs here
define('STRICT_IP_CHECK', false); // Set to true to only allow specific IPs
?>
