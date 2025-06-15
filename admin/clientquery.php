<?php
session_start();
include('connection.php'); // Include your database connection file

// Handle client addition
if (isset($_POST['client_name'], $_FILES['client_image'])) {
    $client_name = $_POST['client_name'];
    
    // Handle image upload
    $client_image = $_FILES['client_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($client_image);
    
    if (move_uploaded_file($_FILES['client_image']['tmp_name'], $target_file)) {
        // Insert data into the database
        $sql = "INSERT INTO clients (client_name, client_image) VALUES ('$client_name', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Client added successfully!";
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
            $_SESSION['message_type'] = 'danger';
        }
    } else {
        $_SESSION['message'] = "Error uploading image.";
        $_SESSION['message_type'] = 'danger';
    }

    // Redirect to the clients list page
    header('Location: clients_list.php');
    exit();
}

// Handle client update
if (isset($_POST['update'], $_POST['client_name'], $_POST['client_id'])) {
    $client_name = $_POST['client_name'];
    $client_id = $_POST['client_id'];

    // Check if a new image is uploaded
    if ($_FILES['client_photo']['name'] != "") {
        // Handle image upload
        $client_image = $_FILES['client_photo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($client_image);
        
        if (move_uploaded_file($_FILES['client_photo']['tmp_name'], $target_file)) {
            // Update client with new image
            $sql = "UPDATE clients SET client_name='$client_name', client_image='$target_file' WHERE client_id='$client_id'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['message'] = "Client updated successfully!";
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = "Error updating client: " . $conn->error;
                $_SESSION['message_type'] = 'danger';
            }
        } else {
            $_SESSION['message'] = "Error uploading image.";
            $_SESSION['message_type'] = 'danger';
        }
    } else {
        // If no new image, just update the client name
        $sql = "UPDATE clients SET client_name='$client_name' WHERE client_id='$client_id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Client updated successfully!";
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = "Error updating client: " . $conn->error;
            $_SESSION['message_type'] = 'danger';
        }
    }

    // Redirect to the clients list page
    header('Location: clients_list.php');
    exit();
}

// Handle client deletion
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // SQL query for deleting the client
    $sql_delete = "DELETE FROM clients WHERE client_id = $client_id";

    if ($conn->query($sql_delete) === TRUE) {
        $_SESSION['message'] = "Client deleted successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error deleting client: " . $conn->error;
        $_SESSION['message_type'] = "danger";
    }

    // Redirect to the clients list page after deletion
    header("Location: clients_list.php");
    exit();
}

$conn->close();
?>
