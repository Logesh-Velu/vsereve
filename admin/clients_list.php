<?php
session_start();
include('connection.php');
// Check if "user_id" is set in the session
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == '') {
    header('Location: index.php');
    exit();
}
// Fetch all clients from the database
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Client List</h2>
        <a href="clients_add.php" class="btn btn-success btn-sm mb-3">Add New Client</a>
        <a href="dashboard.php" class="btn btn-primary btn-sm mb-3">Dashboard</a>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-{$_SESSION['message_type']}'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['client_id'] . "</td>";
                        echo "<td>" . $row['client_name'] . "</td>";
                        echo "<td><img src='" . $row['client_image'] . "' width='50'></td>";
                        echo "<td>
                                <a href='clients_edit.php?client_id=" . $row['client_id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='clientquery.php?client_id=" . $row['client_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No clients found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
