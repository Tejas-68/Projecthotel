<?php
session_start();
include '../config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Fetch booking and payment details using $_GET['id'] or session data
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Booking Confirmed</h2>
        <p>Thank you for your booking! Your payment was successful.</p>
        <!-- Display booking and payment details -->
    </div>
</body>
</html>