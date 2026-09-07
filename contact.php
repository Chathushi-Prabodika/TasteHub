<?php
require_once 'includes/db.php';

$success_msg = '';
$error_msg = '';

// Form එක Submit වූ පසු Process කිරීම
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $message    = trim($_POST['message'] ?? '');

    $full_name = trim($first_name . ' ' . $last_name);

    // Validation Check 
    if (empty($full_name) || empty($email) || empty($message)) {
        $error_msg = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Please enter a valid email address.";
    } else {
        try {
            // Database එකේ messages table එකට Insert කිරීම
            $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
            $stmt->execute([
                ':name'    => $full_name,
                ':email'   => $email,
                ':message' => $message
            ]);
            $success_msg = "Thank you! Your message has been sent successfully.";
        } catch (PDOException $e) {
            $error_msg = "Database Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Taste Hub</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-white">

    <!-- 1. Navigation Bar -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light border-bottom sticky-top py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4 text-dark" href="index.php">
                <i class="bi bi-cup-hot-fill text-danger fs-3"></i> Taste Hub
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link fw-medium" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="recipes.php">Recipes</a></li>
                    <li class="nav-item"><a class="nav-link active fw-semibold text-danger" href="contact.php">Contact</a></li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="input-group d-none d-md-flex">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-0" placeholder="search recipes...">
                    </div>
                    <i class="bi bi-bell fs-5 cursor-pointer"></i>
                    <a href="auth/login.php" class="btn btn-danger px-4 py-2 text-white fw-semibold text-nowrap shadow-sm">Login/Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="container py-5 my-4">
        <div class="row g-5 align-items-center">
            
            <!-- Left Side: Contact Information -->
            <div class="col-lg-5">
                <h1 class="fw-bold mb-3">Get in <span class="text-danger">Touch!</span></h1>
                <p class="text-secondary mb-5">Have a question about a recipe, feedback on our site, or want to share your own culinary creation? We'd love to hear from you.</p>
                
                <!-- Location -->
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-geo-alt-fill fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Our Location</h5>
                        <p class="text-secondary">TasteHub HQ, Rajarata University of Sri Lanka Mihintale</p>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-envelope-fill fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Email Us</h5>
                        <p class="text-secondary">hello@tastehub.com</p>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="d-flex align-items-start gap-3">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-telephone-fill fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Call Us</h5>
                        <p class="text-secondary">+94 77 6509140</p>
                        <p class="text-secondary">+94 70 1166355</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Contact Form Card -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                    <h4 class="fw-bold mb-4 text-dark">Send us a Message</h4>

                    <!-- Display Success or Error Alert -->
                    <?php if (!empty($success_msg)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($success_msg); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error_msg)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($error_msg); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <form action="contact.php" method="POST">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small">First Name</label>
                                <input type="text" name="first_name" class="form-control rounded-3 py-2 bg-light border-0" placeholder="John" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary small">Last Name</label>
                                <input type="text" name="last_name" class="form-control rounded-3 py-2 bg-light border-0" placeholder="Doe">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-secondary small">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-3 py-2 bg-light border-0" placeholder="john@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-secondary small">Message</label>
                                <textarea name="message" class="form-control rounded-3 bg-light border-0" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-danger w-100 py-3 rounded-3 fw-bold">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 text-center text-muted small">
        <div class="container">
            <p class="mb-0">&copy; 2026 Taste Hub. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>