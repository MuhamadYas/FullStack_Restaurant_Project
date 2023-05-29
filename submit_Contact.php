<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $country = $_POST["country"];
    $phoneNumber = $_POST["phone"];
    $password = $_POST["password"];
    $ageRange = $_POST["age_range"];
    $age = $_POST["age"];
    $birthdate = $_POST["birthdate"];
    $registrationTime = $_POST["meeting_time"];
    $registrationDateTime = $_POST["meeting_datetime"];
    $message = $_POST["message"];
    $favoriteMeal = $_POST["favorite_meal"];
    $gender = $_POST["gender"];

    // Compose email content
    $subject = "Contact Form Submission";
    $body = "First Name: " . $firstName . "\n";
    $body .= "Last Name: " . $lastName . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Country: " . $country . "\n";
    $body .= "Phone Number: " . $phoneNumber . "\n";
    $body .= "Password: " . $password . "\n";
    $body .= "Age Range: " . $ageRange . "\n";
    $body .= "Age: " . $age . "\n";
    $body .= "Date of Birth: " . $birthdate . "\n";
    $body .= "Registration Time: " . $registrationTime . "\n";
    $body .= "Registration Date & Time confirmation: " . $registrationDateTime . "\n";
    $body .= "Message: " . $message . "\n";
    $body .= "Favorite Meal: " . $favoriteMeal . "\n";
    $body .= "Gender: " . $gender . "\n";



    // Send the email
    if (mail("muhayass06@gmail.com", $subject, $body)) {
        // Email sent successfully
        echo "Thank you for your message. We will get back to you soon.";
    } else {
        // Failed to send email
        echo "Oops! An error occurred while sending your message. Please try again.";
    }
}
?>
