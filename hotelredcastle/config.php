<?php
$server = "localhost";
$username = "redcastle_user";
$password = "password";
$database = "hotelredcastle";

// Create the connection
$conn = mysqli_connect($server, $username, $password, $database);

// Check the connection
if (!$conn) {
    // Output the specific error
    die("Connection failed: " . mysqli_connect_error());
}

// If the connection is successful, echo this
//echo "Connected successfully";
?>
