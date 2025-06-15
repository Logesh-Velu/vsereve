<?php
include('connection.php');
// Add Banner
if (isset($_POST['submit'])) {
    $bannername = mysqli_real_escape_string($conn, $_POST['bannername']);
    $bannerimage = $_FILES['bannerimage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($bannerimage);

    if (move_uploaded_file($_FILES['bannerimage']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO banner (bannername, bannerimage) VALUES ('$bannername', '$bannerimage')";
        if (mysqli_query($conn, $sql)) {
            echo "Banner added successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    header("Location: bannerlist.php");
    exit;
}

// Update Banner
if (isset($_POST['update_banner'])) {
    $id = (int)$_POST['id'];
    $bannername = mysqli_real_escape_string($conn, $_POST['bannername']);
    $bannerimage = $_FILES['bannerimage']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($bannerimage);

    if (!empty($bannerimage)) {
        // Upload new image
        if (move_uploaded_file($_FILES['bannerimage']['tmp_name'], $target_file)) {
            $sql = "UPDATE banner SET bannername = '$bannername', bannerimage = '$bannerimage' WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                echo "Banner updated successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // If image is not updated, keep the existing image
        $sql = "UPDATE banner SET bannername = '$bannername' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "Banner updated successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    header("Location: bannerlist.php");
    exit;
}

// Delete Banner
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $sql = "DELETE FROM banner WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Banner deleted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    header("Location: bannerlist.php");
    exit;
}