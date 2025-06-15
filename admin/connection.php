<?php
// Check if the environment is localhost or live server
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Localhost configuration
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'vserve';
} else {
    // Server configuration
    $db_host = 'localhost';
    $db_user = 'newline_vserve';
    $db_user = 'newline_vserve';
    $db_password = '!M(+{CnKX,bt';
}

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

