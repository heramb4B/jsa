<?php
// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer autoload if PHPMailer is installed via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                // Use SMTP
        $mail->Host       = 'smtp.gmail.com';           // Set the SMTP server
        $mail->SMTPAuth   = true;                       // Enable SMTP authentication
        $mail->Username   = 'sam.herambk@gmail.com';     // Your Gmail address
        $mail->Password   = 'qjel qpdk udpv xzpc';      // Your Gmail password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                        // TCP port for TLS

        // Recipients
        $mail->setFrom('sam.herambk@gmail.com', 'Heramb');
        $mail->addAddress('sam.herambk@gmail.com', 'Heramb'); // Recipient email

        // Content
        $mail->isHTML(true);                            // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong><br>$message</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message"; // Plain-text for non-HTML email clients

        // Send email
        if ($mail->send()) {
            // If email is sent successfully, show success alert
            echo "<script>alert('Message sent successfully!'); window.location.href = 'index.html';</script>";
        }
    } catch (Exception $e) {
        // If email sending fails, show error alert
        echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}'); window.location.href = 'index.php';</script>";
    }
}
?>
