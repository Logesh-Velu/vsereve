<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Add New Banner</h3>
        </div>
        <div class="card-body">
            <form action="bannerquery.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="bannername" class="form-label">Banner Name:</label>
                    <input type="text" name="bannername" class="form-control" placeholder="Enter banner name" required>
                </div>
                <div class="mb-3">
                    <label for="bannerimage" class="form-label">Banner Image:</label>
                    <input type="file" name="bannerimage" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-primary">Add Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
