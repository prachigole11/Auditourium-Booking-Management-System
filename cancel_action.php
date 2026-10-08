<?php
$conn = new mysqli("localhost","root","","hall_booking");

$id = $_GET['id'];

$conn->query("
UPDATE hall_bookings
SET status='Cancelled'
WHERE id=$id
");

header("Location: cancel_booking.php");