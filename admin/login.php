<?php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    $sql = "SELECT * FROM admin WHERE email = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $data['user_id'];
        
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit(); // Terminate script execution after redirect
    } else {
        echo "INVALID"; // No spaces, no newlines
    }
}
?>
