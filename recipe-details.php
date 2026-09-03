<?php
session_start();
require 'includes/db.php'; 

// Form එක Submit වූ විට ක්‍රියාත්මක වන කොටස
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_recipe'])) {
    
    $title       = trim($_POST['title']);
    $category    = trim($_POST['category']);
    $ingredients = trim($_POST['ingredients']);
    $instructions= trim($_POST['instructions']);
    $user_id     = $_SESSION['user_id'] ?? null; 

    // Image Upload Handling
    $image_name = $_FILES['image']['name'];
    $image_tmp  = $_FILES['image']['tmp_name'];
    
    if (!empty($image_name)) {
        $upload_dir = "images/";
        
        // Image එකට unique නමක් සාදා ගැනීම
        $unique_image_name = time() . '_' . basename($image_name);
        $target_file = $upload_dir . $unique_image_name;

        // Image එක images/ folder එකට Upload කිරීම
        if (move_uploaded_file($image_tmp, $target_file)) {
            try {
                // Database query එක
                $sql = "INSERT INTO recipes (title, category, ingredients, instructions, image, user_id) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $category, $ingredients, $instructions, $target_file, $user_id]);

                echo "<script>alert('Recipe added successfully!'); window.location.href='recipe-details.php';</script>";
                exit();

            } catch (PDOException $e) {
                echo "<script>alert('Database Error: " . addslashes($e->getMessage()) . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image. Please check folder permissions.');</script>";
        }
    } else {
        echo "<script>alert('Please select an image!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TasteHub - Recipe Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

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
                    <li class="nav-item"><a class="nav-link active fw-semibold text-danger" href="recipes.php">Recipes</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="contact.php">Contact</a></li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="input-group d-none d-md-flex">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-0" placeholder="search recipes...">
                    </div>
                    <i class="bi bi-bell fs-5 cursor-pointer"></i>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="auth/logout.php" class="btn btn-outline-danger px-4 py-2 fw-semibold text-nowrap shadow-sm">Logout</a>
                    <?php else: ?>
                        <a href="auth/login.php" class="btn btn-danger px-4 py-2 text-white fw-semibold text-nowrap shadow-sm">Login/Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <a href="recipes.php" class="text-decoration-none text-muted small fw-bold mb-3 d-inline-block">
            &leftarrow; Back to Recipes
        </a>

        <div class="row g-4">
            <!-- Left Side: Recipe Display -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm overflow-hidden mb-4">
                    <img id="recipe-img" src="" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;" alt="Recipe">
                </div>

                <span id="recipe-badge" class="badge bg-success mb-2">Category</span>
                <h2 id="recipe-title" class="fw-bold mb-1">Recipe Title</h2>
                
                <div class="d-flex align-items-center mb-3 text-warning">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                    <span id="recipe-rating" class="text-dark ms-2 fw-bold small">4.8 (128 reviews)</span>
                </div>

                <p id="recipe-desc" class="text-secondary small">Description goes here...</p>
                
                <div class="row text-center g-2 my-3">
                    <div class="col-3"><div class="p-2 border rounded bg-white"><small class="text-muted d-block">Prep Time</small><strong id="prep-time">15 min</strong></div></div>
                    <div class="col-3"><div class="p-2 border rounded bg-white"><small class="text-muted d-block">Cook Time</small><strong id="cook-time">10 min</strong></div></div>
                    <div class="col-3"><div class="p-2 border rounded bg-white"><small class="text-muted d-block">Difficulty</small><strong id="difficulty">Easy</strong></div></div>
                    <div class="col-3"><div class="p-2 border rounded bg-white"><small class="text-muted d-block">Servings</small><strong id="servings">2</strong></div></div>
                </div>

                <div class="d-flex gap-2 my-4">
                    <button class="btn btn-danger btn-sm"><i class="bi bi-bookmark-fill me-1"></i> Save Recipe</button>
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-share me-1"></i> Share</button>
                </div>

                <hr>

                <div class="row my-4">
                    <div class="col-md-5">
                        <h5 class="fw-bold">🥗 Ingredients</h5>
                        <ul id="ingredients-list" class="list-unstyled small text-secondary lh-lg"></ul>
                    </div>

                    <div class="col-md-7">
                        <h5 class="fw-bold">👨‍🍳 Instructions</h5>
                        <ol id="instructions-list" class="small text-secondary lh-lg"></ol>
                    </div>
                </div>

                <hr>

                <div class="my-4">
                    <h5 class="fw-bold mb-3">Comments (5)</h5>
                    <div class="d-flex gap-2 mb-3">
                        <input type="text" class="form-control form-control-sm" placeholder="Write a comment...">
                        <button class="btn btn-danger btn-sm">Post</button>
                    </div>
                    <div class="bg-white p-3 rounded border mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong class="small">Nimasha Perera</strong>
                            <small class="text-muted">Just now</small>
                        </div>
                        <p class="small text-secondary m-0 mt-1">Tried this at home! Turns out so good 😍</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Submit Recipe Form -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-3 mb-4 bg-white">
                    <ul class="nav nav-tabs border-0 mb-3">
                        <li class="nav-item">
                            <button class="nav-link active fw-bold text-danger border-0 border-bottom border-danger" type="button">Add Your Recipe</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link text-secondary border-0" type="button">My Recipes</button>
                        </li>
                    </ul>

                    <h6 class="fw-bold text-center">Share Your Recipe</h6>
                    <p class="text-muted small text-center">Have a delicious recipe? Share it with our community!</p>

                    <!-- Form වෙනස්කම් සිදු කරන ලද කොටස -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label class="form-label small fw-bold">Recipe Name</label>
                            <input type="text" name="title" class="form-control form-control-sm" placeholder="Enter recipe name" required>
                        </div>
                        
                        <div class="mb-2">
                            <label class="form-label small fw-bold">Category</label>
                            <select name="category" class="form-select form-select-sm" required>
                                <option value="">Select category</option>
                                <option value="Salad">Salad</option>
                                <option value="Pizza">Pizza</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                            </select>
                        </div>
                        
                        <div class="mb-2">
                            <label class="form-label small fw-bold">Ingredients</label>
                            <textarea name="ingredients" class="form-control form-control-sm" rows="2" placeholder="Ingredients" required></textarea>
                        </div>
                        
                        <div class="mb-2">
                            <label class="form-label small fw-bold">Instructions</label>
                            <textarea name="instructions" class="form-control form-control-sm" rows="2" placeholder="Instructions" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Upload Image</label>
                            <input type="file" name="image" class="form-control form-control-sm" accept="image/*" required>
                        </div>
                        
                        <button type="submit" name="submit_recipe" class="btn btn-danger w-100 btn-sm fw-bold">Submit Recipe 🚀</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-top py-4 text-center text-muted small">
        <div class="container">
            <p class="mb-0">&copy; 2026 Taste Hub. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/recipe.js"></script>   
</body>
</html>