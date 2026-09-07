<?php
session_start();

// Database Connection එක Check කිරීම (Database Off වී තිබුණත් Page එක Crashed නොවීමට Try-Catch භාවිත කර ඇත)
$db_error = '';
if (file_exists('../includes/db.php')) {
    try {
        require_once '../includes/db.php';
    } catch (Exception $e) {
        $db_error = "Database Connection Failed: Please start MySQL in XAMPP.";
    }
} elseif (file_exists('includes/db.php')) {
    try {
        require_once 'includes/db.php';
    } catch (Exception $e) {
        $db_error = "Database Connection Failed: Please start MySQL in XAMPP.";
    }
}

// Login Processing Logic
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $login_error = "Please fill in all fields.";
    } else if (isset($pdo)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['name'] ?? $user['username'];
                header("Location: ../index.php");
                exit();
            } else {
                $login_error = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $login_error = "Error: " . $e->getMessage();
        }
    } else {
        $login_error = "Database server is offline. Please start MySQL from XAMPP Control Panel.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taste Hub</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- External Custom CSS (auth folder එකේ සිට root එකේ css folder එකට relative path එක) -->
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="login-wrapper">
    <div class="row g-0">
        <!-- LEFT COLUMN: Hero Section -->
        <div class="col-lg-6 hero-section">
            <div>
                <!-- Brand Badge Logo -->
                <div class="brand-logo">
                    <i class="fa-solid fa-fire-burner"></i>
                    <div>
                        <span class="brand-title">Taste Hub</span>
                        <span class="brand-tagline">Discover. Cook. Share.</span>
                    </div>
                </div>

                <!-- Hero Headline -->
                <h1 class="hero-heading">Good Food,<br><span>Good Mood!</span></h1>

                <!-- Subtitle Glassmorphism Box -->
                <div class="hero-description-box">
                    Join our community of food lovers. Discover delicious recipes, share your own creations and bring joy to every meal.
                </div>
            </div>

            <!-- Glassmorphism Stats -->
            <div class="stats-container">
                <div class="stat-badge">
                    <div class="stat-icon">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div>
                        <p class="stat-number">10,000+</p>
                        <p class="stat-label">Delicious Recipes</p>
                    </div>
                </div>

                <div class="stat-badge">
                    <div class="stat-icon">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                    <div>
                        <p class="stat-number">5,000+</p>
                        <p class="stat-label">Happy Users</p>
                    </div>
                </div>

                <div class="stat-badge">
                    <div class="stat-icon">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <p class="stat-number">50+</p>
                        <p class="stat-label">Recipe Categories</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Form Section -->
        <div class="col-lg-6 form-section">
            <div class="form-card">
                <h2 class="form-title" id="formHeader">Welcome Back!</h2>
                <p class="form-subtitle" id="formSubheader">Login to continue your cooking journey</p>

                <!-- Database Alert Message (MySQL Off නම් මෙතනින් දැනුම් දෙනවා) -->
                <?php if (!empty($db_error)): ?>
                    <div class="alert alert-warning py-2 small text-center" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> <?php echo htmlspecialchars($db_error); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($login_error)): ?>
                    <div class="alert alert-danger py-2 small text-center" role="alert">
                        <?php echo htmlspecialchars($login_error); ?>
                    </div>
                <?php endif; ?>

                <!-- Navigation Tabs -->
                <div class="tab-switch">
                    <button class="tab-btn active" id="loginTabBtn" type="button" onclick="switchTab('login')">Login</button>
                    <button class="tab-btn" id="registerTabBtn" type="button" onclick="switchTab('register')">Register</button>
                </div>

                <!-- Login / Register Form -->
                <form id="authForm" action="login.php" method="POST" novalidate>
                    <input type="hidden" name="login" value="1">

                    <!-- Extra Name Field for Register Mode -->
                    <div class="custom-input-group d-none" id="nameGroup">
                        <i class="fa-regular fa-user input-icon-left"></i>
                        <input type="text" name="full_name" class="form-control-custom" id="fullName" placeholder="Full Name">
                        <div class="invalid-feedback-custom" id="nameError">Please enter your full name.</div>
                    </div>

                    <!-- Email Field -->
                    <div class="custom-input-group">
                        <i class="fa-regular fa-envelope input-icon-left"></i>
                        <input type="email" name="email" class="form-control-custom" id="email" placeholder="Email Address" required>
                        <div class="invalid-feedback-custom" id="emailError">Please enter a valid email address.</div>
                    </div>

                    <!-- Password Field -->
                    <div class="custom-input-group">
                        <i class="fa-solid fa-lock input-icon-left"></i>
                        <input type="password" name="password" class="form-control-custom" id="password" placeholder="Password" required>
                        <i class="fa-regular fa-eye input-icon-right" id="togglePassword" title="Toggle Visibility"></i>
                        <div class="invalid-feedback-custom" id="passwordError">Password must be at least 6 characters long.</div>
                    </div>

                    <!-- Options Row -->
                    <div class="form-options" id="optionsRow">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                            <label class="form-check-label text-dark" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="forgot-link" onclick="handleForgotPassword(event)">Forgot Password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span>Login</span>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <span>or Continue with</span>
                </div>

                <!-- Google Login Button -->
                <button type="button" class="btn-google" onclick="handleGoogleLogin()">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo">
                    <span>Continue with Google</span>
                </button>

                <!-- Footer Link -->
                <div class="register-footer" id="footerText">
                    Don't have an account? <a href="#" onclick="switchTab('register'); return false;">Register here</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- External Custom JS -->
<script src="../js/main.js"></script>

</body>
</html>