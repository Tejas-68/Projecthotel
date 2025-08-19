<?php
session_start();
include '../config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("<script>swal({
        title: 'Please log in to proceed with payment',
        icon: 'error',
    }).then(() => { window.location = 'login.php'; });</script>");
}

// Check if booking ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<script>swal({
        title: 'Invalid booking ID',
        icon: 'error',
    });</script>");
}

$booking_id = intval($_GET['id']);

// Fetch booking details
$sql = "SELECT RoomType, Bed, Meal, NoofRoom, nodays FROM roombook WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
$stmt->close();

if (!$booking) {
    die("<script>swal({
        title: 'Booking not found',
        icon: 'error',
    });</script>");
}

// Pricing logic
$room_prices = [
    'Superior Room' => 3000,
    'Deluxe Room' => 2000,
    'Guest House' => 1500,
    'Single Room' => 1000
];

$bed_multipliers = [
    'Single' => 1 / 100,
    'Double' => 2 / 100,
    'Triple' => 3 / 100,
    'Quad' => 4 / 100,
    'None' => 0 / 100
];

$meal_multipliers = [
    'Room only' => 0,
    'Breakfast' => 2,
    'Half Board' => 3,
    'Full Board' => 4
];

// Get booking details
$room_type = $booking['RoomType'];
$bed_type = $booking['Bed'];
$meal_type = $booking['Meal'];
$no_of_days = $booking['nodays'];
$no_of_rooms = $booking['NoofRoom'];

// Validate inputs
if (!array_key_exists($room_type, $room_prices) ||
    !array_key_exists($bed_type, $bed_multipliers) ||
    !array_key_exists($meal_type, $meal_multipliers)) {
    die("<script>swal({
        title: 'Invalid booking details',
        icon: 'error',
    });</script>");
}

// Calculate costs
$total = $room_prices[$room_type] * $no_of_days * $no_of_rooms;
$bed_total = ($room_prices[$room_type] * $bed_multipliers[$bed_type]) * $no_of_days;
$meal_per = ($room_prices[$room_type] * $meal_multipliers[$meal_type]) * $no_of_days;
$final_total = $total + $bed_total + $meal_per;

// Process payment if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay'])) {
    $card_number = $_POST['card_number'] ?? '';
    $card_holder = $_POST['card_holder'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    // Dummy payment validation
    if (strlen($card_number) < 16 || strlen($cvv) < 3 || empty($card_holder)) {
        $error = "Invalid card details.";
    } else {
        // Save transaction to card_payment table
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO card_payment (user_id, booking_id, final_total) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $user_id, $booking_id, $final_total);
        if ($stmt->execute()) {
            // Update roombook status to Confirm
            $stmt = $conn->prepare("UPDATE roombook SET stat = 'Confirm' WHERE id = ?");
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $stmt->close();

            // Show success notification
            echo "<script>swal({
                title: 'Payment successful! Transaction ID: " . $conn->insert_id . "',
                icon: 'success',
            }).then(() => { window.location = 'booking_confirmation.php'; });</script>";
        } else {
            $error = "Payment failed. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .error { color: red; }
        .total { font-weight: bold; margin: 20px 0; }
    </style>
</head>
<body>
    <h2>Payment Details</h2>
    <p class="total">Final Total: ₹<?php echo number_format($final_total, 2); ?></p>

    <?php if (isset($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST">
        <div class="form-group">
            <label for="card_number">Card Number</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
        </div>
        <div class="form-group">
            <label for="card_holder">Card Holder Name</label>
            <input type="text" id="card_holder" name="card_holder" placeholder="John Doe" required>
        </div>
        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="123" required>
        </div>
        <button type="submit" name="pay" class="btn btn-success">Pay Now</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>