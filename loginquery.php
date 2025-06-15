<?php
session_start();  // Start the session
include('connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'admin/vendor/autoload.php';

// Function to send OTP email
function sendOtpEmail($email, $otp, $name) {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.newlineinfotech.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kayal@newlineinfotech.com';
        $mail->Password = '@CgHTmSw}k1x';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('kayal@newlineinfotech.com', 'VServe Global Solutions');
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'OTP for VServe Login';
        $mail->Body    = "Hello $name, <br>Your OTP for login is: <strong>$otp</strong>.<br>Please use this OTP to complete your login.";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Check if form submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Validate input and fetch user
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND phone_number = ?");
    $stmt->bind_param("ss", $email, $phone_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, generate OTP
        $user = $result->fetch_assoc();
        $otp = rand(1000, 9999);

        // Store OTP in the database
        $update_stmt = $conn->prepare("UPDATE user SET otp = ?, is_verified = 0 WHERE id = ?");
        $update_stmt->bind_param("ii", $otp, $user['id']);
        $update_stmt->execute();

        // Send OTP to email
        sendOtpEmail($email, $otp, $user['name']);

        // Save user details in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $email;

        // Redirect to OTP verification
        header("Location: verify_otp.php");
        exit();
    } else {
        echo "Invalid login credentials. Please try again.";
    }
}
?>
