<?php
session_start();

// User කෙනෙක් Login වී නැත්නම් ඔහුව Login Page එකට Redirect කිරීම
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Taste Hub</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Dashboard Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Taste Hub</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="auth/logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Dashboard Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
                    <h1 class="display-6 fw-bold">User Dashboard</h1>
                    <p class="col-md-8 fs-5 text-muted">You are successfully logged in to Taste Hub.</p>
                    <hr class="my-4">
                    <div class="d-flex gap-2">
                        <a href="index.php" class="btn btn-primary">Go to Home</a>
                        <a href="recipes.php" class="btn btn-secondary">Explore Recipes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>