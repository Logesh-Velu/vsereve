<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
<a href='dashboard.php' class='btn btn-success btn-sm'>Dashboard</a>
        <a href='banner_add.php' class='btn btn-primary btn-sm'>Add new banner</a>

    <div class="card">
        
        <div class="card-header">
            <h3 class="text-center">Banner List</h3>
        </div>
        <div class="card-body">
            <?php
          include('connection.php');
            $result = mysqli_query($conn, "SELECT * FROM banner");

            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-bordered table-hover'>
                        <thead class='table-dark'>
                            <tr>
                                <th>ID</th>
                                <th>Banner Name</th>
                                <th>Banner Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['bannername']}</td>
                            <td><img src='uploads/{$row['bannerimage']}' alt='Banner Image' class='img-fluid' width='100'></td>
                            <td>
                                <a href='banneredit.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='bannerquery.php?delete_id={$row['id']}' class='btn btn-success btn-sm'>Delete</a>
                            </td>
                          </tr>";
                }
                echo "</tbody>
                      </table>";
            } else {
                echo "<div class='alert alert-info text-center'>No banners found.</div>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
