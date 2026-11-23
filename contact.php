<?php
$status = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = filter_var(
        trim($_POST["email"] ?? ""),
        FILTER_VALIDATE_EMAIL
    );
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if (!$name || !$email || !$subject || !$message) {
        $status = "Please complete all fields with a valid email.";
    } else {
        $to = "andreane.hiron@cuw.edu"; // Replace with your email
        $subject = "Portfolio contact: " .
            preg_replace('/[\r\n]+/', ' ', $subject);

        $body = "Name: $name\n";
        $body .= "Email: $email\n\n";
        $body .= "Message:\n$message";

        $headers = [
            "From: Portfolio Website <no-reply@andreanehiron.com>",
            "Reply-To: $email",
            "Content-Type: text/plain; charset=UTF-8"
        ];

        if (mail($to, $subject, $body, implode("\r\n", $headers))) {
            $status = "Thank you! Your message has been sent.";
        } else {
            $status = "Sorry, your message could not be sent. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact | Interior Design Portfolio</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
<header class="site-header">

    <a class="brand" href="index.html">
        <span class="brand-mark">A.</span>
        <span>
            INTERIOR DESIGN<br>
            <small>PORTFOLIO</small>
        </span>
    </a>

    <button class="menu-toggle" aria-label="Toggle navigation">
        <span></span>
        <span></span>
    </button>

    <nav class="nav">
        <a class="nav-link" href="index.html">Home</a>

        <a class="nav-link" href="about.html">About Me</a>

        <a class="nav-link" href="projects.html">Projects</a>

        <a class="nav-link nav-contact active" href="contact.php">
            Contact
        </a>
    </nav>

</header>
<main class="inner-page section-wrap contact-page">

    <p class="eyebrow">LET'S CONNECT</p>

    <h1 class="page-title">
        Good things start<br>
        <em>with a conversation.</em>
    </h1>

    <form class="contact-form" action="contact.php" method="POST">

        <label for="name">Your name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email address</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit" class="button button-dark">
            Send message ↗
        </button>

    </form>

    <?php if ($status !== ""): ?>
        <p class="form-status">
            <?= htmlspecialchars($status) ?>
        </p>
    <?php endif; ?>

</main>
    
    
    

    
    
    
</body>