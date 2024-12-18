<?php
session_start();
include('connection.php'); // Include your database connection file

// Fetch banner details to populate the form for editing
if (isset($_GET['id'])) {
    $banner_id = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM banner WHERE id = ?");
    $stmt->bind_param("i", $banner_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $banner = $result->fetch_assoc();
    } else {
        $_SESSION['message'] = "Banner not found!";
        $_SESSION['message_type'] = 'danger';
        header('Location: bannerlist.php');
        exit();
    }
} else {
    // If no banner_id is provided in the URL
    $_SESSION['message'] = "Banner ID is missing!";
    $_SESSION['message_type'] = 'danger';
    header('Location: bannerlist.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Banner</title>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Edit Banner</h3>
        </div>
        <div class="card-body">
            <form action="bannerquery.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($banner['id']); ?>">

                <div class="mb-3">
                    <label for="bannername" class="form-label">Banner Name:</label>
                    <input type="text" name="bannername" class="form-control" value="<?php echo htmlspecialchars($banner['bannername']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="bannerimage" class="form-label">Banner Image:</label>
                    <input type="file" name="bannerimage" class="form-control">
                </div>

                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($banner['bannerimage']); ?>">

                <?php if (!empty($banner['bannerimage'])): ?>
                    <div class="mb-3">
                        <label class="form-label">Current Image:</label><br>
                        <img src="uploads/<?php echo htmlspecialchars($banner['bannerimage']); ?>" alt="Current Image" class="img-thumbnail" width="150">
                    </div>
                <?php endif; ?>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success" name="update_banner">Update Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
