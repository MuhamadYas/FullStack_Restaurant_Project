<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form fields and sanitize input
  $name = sanitize_input($_POST["name"]);
  $email = sanitize_input($_POST["email"]);
  $message = sanitize_input($_POST["message"]);

  // Validate input (you can add more validation if needed)
  $errors = [];
  if (empty($name)) {
    $errors[] = "Name is required.";
  }
  if (empty($email)) {
    $errors[] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }
  if (empty($message)) {
    $errors[] = "Message is required.";
  }

  // If there are no errors, send the email
  if (empty($errors)) {
    $to = "your-email@example.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";

    // You can customize the headers based on your requirements
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
      echo "Thank you for your message. We will get back to you soon!";
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }
  } else {
    // Display the validation errors
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  }
}

// Function to sanitize input data
function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
