<?php
include "DBconnection.php";

// Initialize variables
$email = "";
$password = "";

// Error variable
$login_error = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    // Query the database to check if the user exists
    $query = "SELECT * FROM Customer WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['Password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, perform login logic here
            // For example, set session variables
            session_start();
            $_SESSION['user_email'] = $email;
            echo "<script>alert('Signed in successfully!'); window.location.href = 'index.html';</script>";
            exit();
        } else {
            // Password is incorrect
             echo "<script>alert('Password InCorrect!'); window.location.href = 'LogIn.html';</script>";
            $login_error = "Invalid email or password.";
        }
    } else {
        // User does not exist
         echo "<script>alert('Email does not exist!'); window.location.href = 'LogIn.html';</script>";
        $login_error = "Invalid email or password.";
    }
}
?>
