<?php
// Header
include "connection.php"; // Database connection

// Fetch data from the database
$sql = "SELECT * FROM user ";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    // Handle the error - Query failed
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Hero Area Start -->
    <!-- Hero Area End -->

    <!-- User List Section Start -->
    <section class="contact-section py-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <h2 class="contact-title text-center">Registered Users</h2>
                </div>
                <div class="col-12 text-end">
                    <a href="dashboard.php" class="btn btn-secondary">Home</a>
                    <a href="adduser.php" class="btn btn-secondary">Add User</a>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="userTable">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Insurance Type</th>
                                    <th>Email</th>
                                    <th>Photo</th>
                                    <th>Rc Book</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr class="text-center">
                                            <td><?= $row['id']; ?></td> <!-- Fixed column name -->
                                            <td><?= htmlspecialchars($row['name']); ?></td>
                                            <td><?= htmlspecialchars($row['insurance_type']); ?></td>
                                            <td><?= htmlspecialchars($row['email']); ?></td>
                                            <td>
                                                <!-- Make the image clickable and open it in a new tab -->
                                                <a href="<?= htmlspecialchars($row['photo']); ?>" target="_blank">
                                                <img src="../uploads/photos/<?= htmlspecialchars($row['photo']); ?>" alt="User Image" class="btn btn-info btn-sm" style="max-width: 100px; height: auto;">
                                                </a>
                                            </td>

                                            <td>
                                                <?php
                                                // Check if the document path is not empty
                                                if (!empty($row['rc_book'])):
                                                    // Define the path to the 'uploads/rc_books' folder
                                                    $documentPath = '../uploads/rc_books/' . htmlspecialchars($row['rc_book']);
                                                ?>
                                                    <a href="<?= $documentPath; ?>" target="_blank" class="btn btn-info btn-sm">Download</a>
                                                <?php else: ?>
                                                    <span class="text-muted">No document</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="edit_user.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a> <!-- Fixed column name -->
                                            </td>
                                            <td>
                                                <a href="delete_user.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-sm">Delete</a> <!-- Fixed column name -->
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="13" class="text-center">No users found.</td> <!-- Adjusted colspan for 13 columns -->
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User List Section End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
</body>

</html>