<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin-top: 100px;
        }
        .timer {
            font-size: 14px;
            color: red;
        }
        .otp-label {
            font-weight: bold;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="text-center">
        <h2>OTP Verification</h2>
        <p>Enter the OTP sent to your email.</p>
    </div>
    <form id="otpForm">
        <div class="form-group">
            <label for="otp" class="otp-label">OTP</label>
            <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
            <div id="error" class="error"></div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
    <div id="timer" class="timer text-center mt-3">OTP expires in: <span id="time">10:00</span></div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('otpForm');
        var timerElement = document.getElementById('time');
        var errorElement = document.getElementById('error');
        var otpTimer = 600; // 10 minutes in seconds

        // Function to update the timer display
        function updateTimer() {
            var minutes = Math.floor(otpTimer / 60);
            var seconds = otpTimer % 60;
            timerElement.textContent = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            if (otpTimer > 0) {
                otpTimer--;
            } else {
                clearInterval(timerInterval);
                timerElement.textContent = 'Expired';
                document.getElementById('otp').disabled = true; // Disable input after expiry
            }
        }

        // Update timer every second
        var timerInterval = setInterval(updateTimer, 1000);

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var otp = document.getElementById('otp').value;
            var errorMessage = '';

            // Validate OTP
            if (!/^\d{6}$/.test(otp)) {
                errorMessage = 'OTP must be a 6-digit number.';
            }

            if (errorMessage) {
                errorElement.textContent = errorMessage; // Show error message
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'otpquery.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        if (response === "success") {
                            window.location.href = "dashboard.php"; // Redirect on successful OTP verification
                        } else {
                            errorElement.textContent = response; // Show error message
                        }
                    } else {
                        errorElement.textContent = "An error occurred. Please try again."; // Handle server errors
                    }
                }
            };

            xhr.send('otp=' + encodeURIComponent(otp));
        });
    });
</script>

</body>
</html>
