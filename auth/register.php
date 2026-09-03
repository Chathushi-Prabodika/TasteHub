<?php
// Bring in your database connection
require '../includes/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hashing the password perfectly to assignment standards
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Prepared statements act like a bouncer to stop SQL injection
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);
        
        echo "<script>alert('Registration successful! Time to login.'); window.location.href='login.php';</script>";
    } catch (PDOException $e) {
        // If the email already exists, it will catch the error here
        echo "<script>alert('Error: Email might already be taken!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - TasteHub</title>
</head>
<body>
    <!-- A simple form to test our backend connection -->
    <h2>Join TasteHub</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="email" name="email" placeholder="Email Address" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>