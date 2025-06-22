<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set your email address here
    $to = "itsabishekjha@gmail.com"; // <-- Replace this with your email

    // Get form data safely
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Optional phone number handling (was missing name attribute in your form)
    $phone = isset($_POST["phone"]) ? htmlspecialchars(trim($_POST["phone"])) : 'Not provided';

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill out all required fields.";
        exit;
    }

    // Compose email
    $email_subject = !empty($subject) ? $subject : "New Contact Form Submission";
    $email_body = "You have received a new message from your website contact form:\n\n" .
                  "Name: $name\n" .
                  "Email: $email\n" .
                  "Phone: $phone\n" .
                  "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request
    echo "Invalid request.";
}
?>
