<!DOCTYPE html>
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

<form class="contact-form" action="contact.php" method="POST">

    <label for="name">Your name</label>
    <input
        type="text"
        id="name"
        name="name"
        placeholder="Full name"
        autocomplete="name"
        required
    >

    <label for="email">Email address</label>
    <input
        type="email"
        id="email"
        name="email"
        placeholder="you@example.com"
        autocomplete="email"
        required
    >

    <label for="subject">Subject</label>
    <input
        type="text"
        id="subject"
        name="subject"
        placeholder="Internship opportunity, project inquiry..."
        required
    >

    <label for="message">Message</label>
    <textarea
        id="message"
        name="message"
        rows="5"
        placeholder="Write your message here..."
        required
    ></textarea>

    <?php if ($status !== ""): ?>
        <p class="form-status" role="status">
            <?= htmlspecialchars($status, ENT_QUOTES, "UTF-8") ?>
        </p>
    <?php endif; ?>

    <button type="submit" class="button button-dark">
        Send message <span aria-hidden="true">↗</span>
    </button>

</form>