<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h2 class="contact-title">Create an Account</h2>
                <p class="text-muted">Fill in the details below to create your account</p>
            </div>
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="userquery.php" method="POST" enctype="multipart/form-data" id="accountForm">
                            <div class="mb-3">
                                <label for="user_name" class="form-label">User Name:</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label for="insurance_type" class="form-label">Insurance Type:</label>
                                <select class="form-select" id="insurance_type" name="insurance_type" required>
                                    <option value="" selected disabled>Select Insurance Type</option>
                                    <option value="business">Business Insurance</option>
                                    <option value="motor">Motor Insurance</option>
                                    <option value="health">Health Insurance</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location:</label>
                                <input type="text" class="form-control" id="location" name="location" value="Chennai" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="mb-3">
                                <label for="document" class="form-label">Upload Document (PDF/DOC):</label>
                                <input type="file" class="form-control" id="document" name="document" accept=".pdf,.doc,.docx">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Photo (JPG, JPEG, PNG, GIF):</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
