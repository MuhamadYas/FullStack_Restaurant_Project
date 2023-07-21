<?php
ob_start(); // Start output buffering

include "DBconnection.php";

// Initialize variables
$user_name = "";
$lastname = "";
$password_ = "";
$phonenumber = "";
$email = "";
$confirmpassword = "";
$hashed_password = "";

// Define error variables
$name_error = "";
$phone_error = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['firstName'];
    $lastname = $_POST['LastName'];
    $password_ = $_POST['signup-password'];
    $phonenumber = $_POST['phone'];
    $email = $_POST['signup-email'];
    $confirmpassword = $_POST['signup-password-confirm'];
    $hashed_password = password_hash($password_, PASSWORD_DEFAULT);

    // Validate first and last name to accept only letters
    if (!preg_match("/^[a-zA-Z]+$/", $user_name) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
        $name_error = "Invalid input for first or last name. Please use only letters.";
    }

    // Validate phone number to accept only numbers
    if (!is_numeric($phonenumber)) {
        $phone_error = "Invalid input for phone number. Please use only numbers.";
    }

    if (empty($name_error) && empty($phone_error)) {
        $check_phonenumber = "SELECT * FROM Customer WHERE PhoneNumber = '$phonenumber'";
        $result = mysqli_query($conn, $check_phonenumber);

        if (mysqli_num_rows($result) != 0) {
            $phone_error = "This phone number is already signed up.";
        } elseif ($password_ != $confirmpassword) {
            $phone_error = "The passwords do not match! Please try again.";
        } else {
            $sql = "INSERT INTO Customer(FirstName,LastName,Email,Password,PhoneNumber)
            VALUES ('$user_name','$lastname','$email','$hashed_password','$phonenumber')";

            if ($conn->query($sql) === TRUE) {
                ob_end_clean(); // Clear the output buffer
                header('Location: LogIn.html'); // Redirect with query parameter
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Head content goes here -->
</head>
<body>
  <section class="forms-section">
    <!-- HTML code for signup and login forms goes here -->
  </section>

  <script>
    const switchers = [...document.querySelectorAll('.switcher')];

    switchers.forEach(item => {
      item.addEventListener('click', function() {
        switchers.forEach(item => item.parentElement.classList.remove('is-active'));
        this.parentElement.classList.add('is-active');
      });
    });

    // Add the following code to display the login form after successful signup
    const urlParams = new URLSearchParams(window.location.search);
    const signupSuccess = urlParams.get('signupSuccess');

    if (signupSuccess) {
      document.querySelector('.form-wrapper').classList.remove('is-active');
      document.querySelector('.form-wrapper.is-active').classList.remove('is-active');
      document.querySelector('.switcher-login').parentElement.classList.add('is-active');
      document.querySelector('.form-login').parentElement
