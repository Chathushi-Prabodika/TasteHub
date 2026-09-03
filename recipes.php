<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TasteHub - Recipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
   
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
                    <a href="auth/login.php" class="btn btn-danger px-4 py-2 text-white fw-semibold text-nowrap shadow-sm">Login/Register</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container text-center my-5">
        <h1 class="fw-bold">Delicious Recipes 🍳</h1>
        <p class="text-muted">Explore our curated collection of quick and mouthwatering dishes.</p>
    </div>

    <div class="container mb-5">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500" class="card-img-top" alt="Salad">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Fresh Avocado Salad</h5>
                        <p class="card-text text-secondary">A healthy and crisp salad topped with creamy avocado and lemon dressing.</p>
                        <a href="recipe-details.php?id=salad" class="btn btn-warning btn-sm w-100 fw-bold">View Recipe</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500" class="card-img-top" alt="Pizza">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Classic Cheese Pizza</h5>
                        <p class="card-text text-secondary">Freshly baked pizza with extra mozzarella cheese and rich tomato sauce.</p>
                        <a href="recipe-details.php?id=pizza" class="btn btn-warning btn-sm w-100 fw-bold">View Recipe</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="images/Belgian-Waffls.jpg" class="card-img-top" alt="Dessert">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Berry Waffle Pancakes</h5>
                        <p class="card-text text-secondary">Fluffy pancakes served with fresh berries, maple syrup, and cream.</p>
                        <a href="recipe-details.php?id=waffles" class="btn btn-warning btn-sm w-100 fw-bold">View Recipe</a>
                    </div>
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
</body>
</html>