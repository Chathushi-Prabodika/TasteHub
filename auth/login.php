<?php
// Always start the session at the very top!
session_start();
require '../includes/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Fetch the user data based on the email provided
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Verify the password against the hashed password in the database
        if ($user && password_verify($password, $user['password'])) {
            
            // This is strictly required by your assignment to prevent session hijacking!
            session_regenerate_id(true); 
            
            // Store user details in the session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect to the index page (Home page)
            echo "<script>alert('Login successful!'); window.location.href='../index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Invalid email or password! Please try again.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database Error!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - TasteHub</title>
</head>
<body>
    <h2>Login to TasteHub</h2>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email Address" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>