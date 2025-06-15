<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if no user_id is found in session
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

// Database Connection
include('connection.php');

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id = '$user_id'";
$result = $conn->query($query);

// Initialize $user to an empty array in case no result is found
$user = null;

// Check if query returned any results
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Fetch user data
} else {
    echo "No user data found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>V Serve Global Solutions</title>
    <!-- Link your stylesheets and other resources -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <section class="product-form-banner">
    <div class="container" id="form-banner-left">
        <div class="row">
            <!-- Image section: 6 columns on medium screens and larger -->
            <div class="col-md-6">
                <div style="padding: 5%;">
                    <img src="img/product-form-img.png" alt="Product Image" width="100%">
                </div>
            </div> 

            <!-- Form section: 6 columns on medium screens and larger -->
            <div class="col-md-6">
                <div class="container mt-5">
                    <h2 class="text-center mb-2">User Profile</h2>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form action="userquery.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />

                                <div class="mb-3">
                                    <label>Your Name</label>
                                    <input type="text" name="user_name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" value="<?php echo isset($user['phone_number']) ? $user['phone_number'] : ''; ?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?php echo isset($user['address']) ? $user['address'] : ''; ?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Vehicle Number</label>
                                    <input type="text" name="vehicle_number" value="<?php echo isset($user['vehicle_number']) ? $user['vehicle_number'] : ''; ?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Chase/Engine Number</label>
                                    <input type="text" name="chase_number" value="<?php echo isset($user['chase_number']) ? $user['chase_number'] : ''; ?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Location</label>
                                    <input type="text" name="location" value="<?php echo isset($user['location']) ? $user['location'] : ''; ?>" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Insurance Type</label>
                                    <select name="insurance_type" class="form-control" required>
                                        <option value="" disabled selected>Select Insurance Type</option>
                                        <option value="Life Insurance" <?php echo (isset($user['insurance_type']) && $user['insurance_type'] == 'Life Insurance') ? 'selected' : ''; ?>>Life Insurance</option>
                                        <option value="Health Insurance" <?php echo (isset($user['insurance_type']) && $user['insurance_type'] == 'Health Insurance') ? 'selected' : ''; ?>>Health Insurance</option>
                                        <option value="Home Insurance" <?php echo (isset($user['insurance_type']) && $user['insurance_type'] == 'Home Insurance') ? 'selected' : ''; ?>>Home Insurance</option>
                                        <option value="Vehicle Insurance" <?php echo (isset($user['insurance_type']) && $user['insurance_type'] == 'Vehicle Insurance') ? 'selected' : ''; ?>>Vehicle Insurance</option>
                                        <option value="Business Insurance" <?php echo (isset($user['insurance_type']) && $user['insurance_type'] == 'Business Insurance') ? 'selected' : ''; ?>>Business Insurance</option>
                                        <option value="Property Insurance" <?php echo (isset($user['insurance_type']) && $user['insurance_type'] == 'Property Insurance') ? 'selected' : ''; ?>>Property Insurance</option>
                                    </select>
                                </div>

                                                        <div class="mb-3">
                            <label>Aadhar Card</label><br>
                            <?php if (isset($user['adharcard']) && !empty($user['adharcard'])): ?>
                                <a href="uploads/adharcards/<?php echo $user['adharcard']; ?>" target="_blank">View Aadhar</a><br>
                            <?php endif; ?>
                            <input type="file" name="adharcard" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>PAN Card</label><br>
                            <?php if (isset($user['pancard']) && !empty($user['pancard'])): ?>
                                <a href="uploads/pancards/<?php echo $user['pancard']; ?>" target="_blank">View PAN</a><br>
                            <?php endif; ?>
                            <input type="file" name="pancard" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Profile Photo</label><br>
                            <?php if (isset($user['photo']) && !empty($user['photo'])): ?>
                                <img src="uploads/photos/<?php echo $user['photo']; ?>" width="100" alt="Profile Photo"><br>
                            <?php endif; ?>
                            <input type="file" name="photo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>RC Book</label><br>
                            <?php if (isset($user['rc_book']) && !empty($user['rc_book'])): ?>
                                <a href="uploads/rc_books/<?php echo $user['rc_book']; ?>" target="_blank">View RC Book</a><br>
                            <?php endif; ?>
                            <input type="file" name="rc_book" class="form-control">
                        </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <?php include('footer.php'); ?>

    <!-- JS Libraries -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
</body>
</html>
