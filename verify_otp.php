<?php
session_start();
include('connection.php');

// Check if form submitted
if (isset($_POST['verify'])) {
    $entered_otp = $_POST['otp'];
    $user_id = $_SESSION['user_id'];

    // Fetch the stored OTP
    $stmt = $conn->prepare("SELECT otp FROM user WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($entered_otp == $user['otp']) {
        // Update is_verified to 1
        $update_stmt = $conn->prepare("UPDATE user SET is_verified = 1 WHERE id = ?");
        $update_stmt->bind_param("i", $user_id);
        $update_stmt->execute();

        echo "OTP Verified Successfully! Redirecting...";
        // Redirect to dashboard or login success page
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow-sm p-4" style="width: 400px;">
            <div class="card-body">
                <h3 class="text-center mb-4">Verify OTP</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP</label>
                        <input type="number" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
                    </div>
                    <button type="submit" name="verify" class="btn btn-primary w-100">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle (Popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

