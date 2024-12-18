<?php
session_start();

// Retrieve the OTP entered by the user and the OTP stored in the session
$otp = $_POST['otp'];
$verify_otp = $_SESSION['otp'];

// Validate OTP format
if (!preg_match('/^\d{6}$/', $otp)) {
    echo "Invalid OTP format. It must be a 6-digit number.";
    exit(); // Ensure script execution stops after the validation
}


// Verify the OTP
if ($otp == $verify_otp) {
    // OTP is correct
    echo "success";
} else {
    // OTP is incorrect
    echo "Invalid OTP. Please try again.";
}
?>
