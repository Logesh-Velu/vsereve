<?php
include 'connection.php';
session_start();

// Check if "user_id" is set in the session
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == '') {
    header('Location: index.php');
    exit();
}

// Query to count clients
$clientCount = 0;
$testimonialCount = 0;
$jobOpeningCount = 0;
$userCount = 0;

// Query to count clients
$clientCountQuery = "SELECT COUNT(*) AS total_clients FROM clients";
$clientResult = $conn->query($clientCountQuery);
if ($clientResult) {
    $clientCount = $clientResult->fetch_assoc()['total_clients'];
} else {
    echo "Error in client count query: " . $conn->error;
}

// Query to count users
$userCountQuery = "SELECT COUNT(*) AS total_user FROM user";
$userResult = $conn->query($userCountQuery);
if ($userResult) {
    $userCount = $userResult->fetch_assoc()['total_user'];
} else {
    echo "Error in user count query: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar styling */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ddd;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 1.1rem;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header {
            text-align: center;
            padding: 2rem;
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">Dashboard</h3>
        <a href="bannerlist.php">Banner</a>
        <a href="clients_list.php">Clients</a>
        <a href="userlist.php">Users</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
        </div>

        <!-- Dashboard Content -->
        <div class="container mt-4">
            <div class="row">
                <!-- Clients Section -->
                <div class="col-md-4" id="clients">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Clients</h5>
                        </div>
                        <div class="card-body">
                            <p>Total Clients: <strong><?php echo $clientCount; ?></strong></p>
                            <button class="btn btn-primary btn-block" onclick="location.href='clients_list.php'">View Clients</button>
                        </div>
                    </div>
                </div>

                <!-- Users Section -->
                <div class="col-md-4" id="users">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5>Users</h5>
                        </div>
                        <div class="card-body">
                            <p>No Of Users: <strong><?php echo $userCount; ?></strong></p>
                            <button class="btn btn-success btn-block" onclick="location.href='userlist.php'">Manage Users</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>