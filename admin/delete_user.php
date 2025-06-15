<?php
include "connection.php"; // Database connection

// Check if the 'id' parameter is passed
if (isset($_GET['id'])) {
    // Get the user ID from the URL
    $user_id = $_GET['id'];

    // Prepare SQL query to delete the user
    $sql = "DELETE FROM user WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the user ID to the SQL query
        $stmt->bind_param("i", $user_id);

        // Execute the query
        if ($stmt->execute()) {
            // If successful, redirect to user list page
            header("Location: userlist.php");
            exit();
        } else {
            // If there is an error, display it
            echo "Error deleting user: " . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing the query: " . $conn->error;
    }
} else {
    echo "User ID is missing!";
}

// Close the database connection
$conn->close();
?>
