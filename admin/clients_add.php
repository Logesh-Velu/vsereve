
<?php
session_start();
include('connection.php'); // Include your database connection file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add Client</h2>
        
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-{$_SESSION['message_type']}'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <form action="clientquery.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="client_name">Client Name</label>
                <input type="text" name="client_name" id="client_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="client_image">Client Image</label>
                <input type="file" name="client_image" id="client_image" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit Client</button>
            <a href="clients_list.php" class="btn btn-primary btn-sm">Cancel</a>

        </form>
    </div>
</body>
</html>
