<?php
include '../config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM roombook WHERE id = '$id'";
$re = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_array($re)) {
    $Name = $row['Name'];
    $Email = $row['Email'];
    $Country = $row['Country'];
    $Phone = $row['Phone'];
    $RoomType = $row['RoomType'];
    $Bed = $row['Bed'];
    $NoofRoom = $row['NoofRoom'];
    $Meal = $row['Meal'];
    $cin = $row['cin'];
    $cout = $row['cout'];
    $noofday = $row['nodays'];
    $stat = $row['stat'];

    if ($stat == "NotConfirm") {
        // Update room booking status to "Confirm"
        $update = "UPDATE roombook SET stat = 'Confirm' WHERE id = '$id'";
        if (mysqli_query($conn, $update)) {
            
            // Room prices
            $roomPrices = [
                "Superior Room" => 3000,
                "Deluxe Room" => 2000,
                "Guest House" => 1500,
                "Single Room" => 1000
            ];

            $bedRates = [
                "Single" => 0.01,
                "Double" => 0.02,
                "Triple" => 0.03,
                "Quad" => 0.04,
                "None" => 0
            ];

            $mealMultipliers = [
                "Room only" => 0,
                "Breakfast" => 2,
                "Half Board" => 3,
                "Full Board" => 4
            ];

            $roomPrice = $roomPrices[$RoomType] ?? 0;
            $bedRate = $bedRates[$Bed] ?? 0;
            $mealMultiplier = $mealMultipliers[$Meal] ?? 0;

            // Totals
            $roomTotal = $roomPrice * $noofday * $NoofRoom;
            $bedPrice = $roomPrice * $bedRate;
            $bedTotal = $bedPrice * $noofday;
            $mealTotal = ($bedPrice * $mealMultiplier) * $noofday;

            $finalTotal = $roomTotal + $bedTotal + $mealTotal;

            // Insert into payment table
            $insert = "INSERT INTO payment (
                id, Name, Email, RoomType, Bed, NoofRoom, cin, cout, noofdays,
                roomtotal, bedtotal, meal, mealtotal, finaltotal
            ) VALUES (
                '$id', '$Name', '$Email', '$RoomType', '$Bed', '$NoofRoom', '$cin', '$cout', '$noofday',
                '$roomTotal', '$bedTotal', '$Meal', '$mealTotal', '$finalTotal'
            )";

            if (mysqli_query($conn, $insert)) {
                header("Location: roombook.php");
                exit();
            } else {
                echo "Error inserting payment: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating booking status: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Guest Already Confirmed'); window.location.href='roombook.php';</script>";
    }
} else {
    echo "Booking not found.";
}
?>
