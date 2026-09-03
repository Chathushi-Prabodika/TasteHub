<?php
// Function to sanitize and clean form input data
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if a user is currently logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}
?>