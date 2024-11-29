<?php
  // Replace with your real email address
  $receiving_email_address = 'jmcclinton8@gmail.com'; // Your email

  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and sanitize it
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo 'Invalid email format';
      exit;
    }

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    // Email subject
    $email_subject = "Contact Form Submission: " . $subject;

    // Email body (HTML format)
    $email_body = "<html><body>";
    $email_body .= "<h2>New Contact Form Submission</h2>";
    $email_body .= "<p><strong>Name:</strong> " . $name . "</p>";
    $email_body .= "<p><strong>Email:</strong> " . $email . "</p>";
    $email_body .= "<p><strong>Subject:</strong> " . $subject . "</p>";
    $email_body .= "<p><strong>Message:</strong></p>";
    $email_body .= "<p>" . nl2br($message) . "</p>";
    $email_body .= "</body></html>";

    // Send email
    if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
      echo "success"; // Will return "success" on successful email
    } else {
      echo "failure"; // Will return "failure" if email fails
    }
  }
?>
