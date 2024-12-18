<?php
session_start();
include('connection.php'); // Include your database connection file

// Fetch client details to populate the form for editing
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    $sql = "SELECT * FROM clients WHERE client_id = '$client_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
    } else {
        $_SESSION['message'] = "Client not found!";
        $_SESSION['message_type'] = 'danger';
        header('Location: clients_list.php');
        exit();
    }
} else {
    // If no client_id is provided in the URL
    $_SESSION['message'] = "Client ID is missing!";
    $_SESSION['message_type'] = 'danger';
    header('Location: clients_list.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Client</h2>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-{$_SESSION['message_type']}'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <form action="clientquery.php?client_id=<?php echo $client['client_id']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="client_id" value="<?php echo $client['client_id']; ?>">

            <div class="form-group">
                <label for="client_name">Client Name</label>
                <input type="text" name="client_name" id="client_name" class="form-control" value="<?php echo htmlspecialchars($client['client_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="client_image">Client Image</label>
                <input type="file" name="client_photo" id="client_image" class="form-control">
                <img src="<?php echo $client['client_image']; ?>" width="100" alt="Current Image">
            </div>
            <button type="submit" name="update" class="btn btn-primary btn-sm">Update Client</button>
            <a href="clients_list.php" class="btn btn-primary btn-sm">Cancel</a>

        </form>
    </div>
</body>
</html>
