<?php
include "connection.php"; // Database connection

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT id, name, insurance_type, location, email, rc_book, phone_number, photo FROM user WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    
    // Check if query ran successfully
    if (!$result) {
        echo "<p>Error executing query: " . mysqli_error($conn) . "</p>";
        exit;
    }
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<p>User not found with ID: $id</p>";
        exit;
    }
}    

// Update the user data when the form is submitted
if (isset($_POST['update'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $insurance_type = mysqli_real_escape_string($conn, $_POST['insurance_type']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $document = $_FILES['document']['name'];
    $image = $_FILES['image']['name'];

    // Handle file upload for the document
    if (!empty($document)) {
        $document_tmp = $_FILES['document']['tmp_name'];
        $document_path = "uploads/" . $document;
        move_uploaded_file($document_tmp, $document_path);
    } else {
        $document_path = $row['document']; // Keep the old document if no new one is uploaded
    }

    // Handle file upload for the image
    if (!empty($image)) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image;
        move_uploaded_file($image_tmp, $image_path);
    } else {
        $image_path = $row['images']; // Keep the old image if no new one is uploaded
    }

    // Update the user data in the database
    $update_sql = "UPDATE user SET user_name='$user_name', insurance_type='$insurance_type', location='$location', email='$email', document='$document', phone='$phone', images='$image_path' WHERE id='$id'";

    if (mysqli_query($conn, $update_sql)) {
        echo "<p>User updated successfully.</p>";
        header("Location: userlist.php"); // Redirect to the user list page
        exit;
    } else {
        echo "<p>Error updating user: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Hero Area Start -->
<div class="slider-area">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Edit User</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End -->

<!-- Edit User Form Start -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title text-center mb-4">Edit User</h2>
            </div>
            <div class="col-lg-8 offset-lg-2">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?= htmlspecialchars($row['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="insurance_type" class="form-label">Insurance Type</label>
                        <select class="form-control" id="insurance_type" name="insurance_type" required>
                            <option value="Life Insurance" <?= $row['insurance_type'] == 'Life Insurance' ? 'selected' : ''; ?>>Life Insurance</option>
                            <option value="Health Insurance" <?= $row['insurance_type'] == 'Health Insurance' ? 'selected' : ''; ?>>Health Insurance</option>
                            <option value="Home Insurance" <?= $row['insurance_type'] == 'Home Insurance' ? 'selected' : ''; ?>>Home Insurance</option>
                            <option value="Vehicle Insurance" <?= $row['insurance_type'] == 'Vehicle Insurance' ? 'selected' : ''; ?>>Vehicle Insurance</option>
                            <option value="Business Insurance" <?= $row['insurance_type'] == 'Business Insurance' ? 'selected' : ''; ?>>Business Insurance</option>
                            <option value="Property Insurance" <?= $row['insurance_type'] == 'Property Insurance' ? 'selected' : ''; ?>>Property Insurance</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($row['location']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($row['email']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($row['phone_number']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <?php if (!empty($row['photo'])):
                            $imagePath = htmlspecialchars($row['photo']);
                            $imageParts = explode('../uploads/photos', $imagePath);
                            $imagePath = end($imageParts);  ?>
                            <img src="<?= $imagePath; ?>" alt="User Image" class="btn btn-info btn-sm" style="max-width: 100px; height: auto;">
                            <p class="mt-2">Current Image: <a href="<?= $imagePath; ?>" target="_blank">View Image</a></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="rc_book" class="form-label">RC book</label>
                        <input type="file" class="form-control" id="rc_book" name="document">
                        <?php
                            $documentPath = htmlspecialchars($row['rc_book']);

                            // Define the base path to remove
                            $basePath = './uploads/rc_books/';

                            // Check if the document path contains the base path
                            if (strpos($documentPath, $basePath) !== false) {
                                // Remove the base path using explode
                                $documentParts = explode($basePath, $documentPath);
                                $documentFile = end($documentParts); // Get the file part after the base path
                                echo "<p>Document File: $documentFile</p>"; // Display the document file
                            } else {
                                echo "<p>Document path is not valid.</p>";
                            }
                            ?>
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Update User</button>
                    <a href="userlist.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Edit User Form End -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
