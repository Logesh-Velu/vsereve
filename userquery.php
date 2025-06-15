<?php
include("connection.php");

// Function to create directory if it doesn't exist
function ensureDirectoryExists($path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

// Ensure upload directories exist
ensureDirectoryExists("uploads/adharcards/");
ensureDirectoryExists("uploads/pancards/");
ensureDirectoryExists("uploads/rc_books/");
ensureDirectoryExists("uploads/photos/");

// Initialize paths
$photo_path = $adharcard_path = $pancard_path = $rc_book_path = "";

// Check if form is submitted for update
if (isset($_POST['submit'])) {
    // Retrieve input values
    $user_id = $_POST['user_id']; // Assume user_id is passed in a hidden input field
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $vehicle_number = $_POST['vehicle_number'];
    $chase_number = $_POST['chase_number'];
    $insurance_type = $_POST['insurance_type'];
    $location = $_POST['location'];
    
    // Fetch current user details
    $current_user_sql = "SELECT * FROM user WHERE id = '$user_id'";
    $current_user_result = $conn->query($current_user_sql);
    $current_user = $current_user_result->fetch_assoc();

    // File upload handling with validation and keeping previous files if not updated
    if (!empty($_FILES['adharcard']['name']) && is_uploaded_file($_FILES['adharcard']['tmp_name'])) {
        $adharcard_name = time() . "_" . basename($_FILES['adharcard']['name']);
        $target_path = "uploads/adharcards/" . $adharcard_name;
        if (move_uploaded_file($_FILES['adharcard']['tmp_name'], $target_path)) {
            $adharcard_path = $adharcard_name; // Store only the filename
        } else {
            die("Failed to upload Aadhar Card.");
        }
    } else {
        // If no new Aadhar card, keep the previous one
        $adharcard_path = $current_user['adharcard'];
    }

    if (!empty($_FILES['pancard']['name']) && is_uploaded_file($_FILES['pancard']['tmp_name'])) {
        $pancard_name = time() . "_" . basename($_FILES['pancard']['name']);
        $target_path = "uploads/pancards/" . $pancard_name;
        if (move_uploaded_file($_FILES['pancard']['tmp_name'], $target_path)) {
            $pancard_path = $pancard_name; // Store only the filename
        } else {
            die("Failed to upload Pancard.");
        }
    } else {
        // If no new Pancard, keep the previous one
        $pancard_path = $current_user['pancard'];
    }

    if (!empty($_FILES['photo']['name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
        $photo_name = time() . "_" . basename($_FILES['photo']['name']);
        $target_path = "uploads/photos/" . $photo_name;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
            $photo_path = $photo_name; // Store only the filename
        } else {
            die("Failed to upload Photo.");
        }
    } else {
        // If no new Photo, keep the previous one
        $photo_path = $current_user['photo'];
    }

    if (!empty($_FILES['rc_book']['name']) && is_uploaded_file($_FILES['rc_book']['tmp_name'])) {
        $rc_book_name = time() . "_" . basename($_FILES['rc_book']['name']);
        $target_path = "uploads/rc_books/" . $rc_book_name;
        if (move_uploaded_file($_FILES['rc_book']['tmp_name'], $target_path)) {
            $rc_book_path = $rc_book_name; // Store only the filename
        } else {
            die("Failed to upload RC Book.");
        }
    } else {
        // If no new RC Book, keep the previous one
        $rc_book_path = $current_user['rc_book'];
    }

    // Update query - Save the user data along with filenames
    $update_sql = "UPDATE user SET 
                   name = '$name', 
                   email = '$email', 
                   phone_number = '$phone_number', 
                   address = '$address', 
                   adharcard = '$adharcard_path', 
                   pancard = '$pancard_path', 
                   photo = '$photo_path', 
                   vehicle_number = '$vehicle_number', 
                   chase_number = '$chase_number', 
                   insurance_type = '$insurance_type',
                   location = '$location',

                   rc_book = '$rc_book_path' 
                   WHERE id = '$user_id'";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: profile.php"); // Redirect to profile page after successful update
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
