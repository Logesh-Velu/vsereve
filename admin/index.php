<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            width: 100%;
            border-radius: 50px;
        }
        .spinner {
            display: none;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Login</h4>
                    <form action="login.php" method="post">
                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>

                        <!-- Buttons -->
                        <div class="">
                            <button type="submit" class="btn btn-success w-auto">Login</button>
                            <a href="addprofile.php" class="btn btn-secondary btn-m w-auto">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
