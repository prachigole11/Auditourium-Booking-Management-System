<?php
$conn = new mysqli("localhost","root","","hall_booking");

$hall = $_POST['hall'];
$date = $_POST['date'];
$slot = $_POST['slot'];

$q = $conn->prepare(
    "SELECT id FROM hall_bookings 
     WHERE hall_name=? AND booking_date=? AND time_slot=?"
);
$q->bind_param("sss",$hall,$date,$slot);
$q->execute();
$r = $q->get_result();

if($r->num_rows > 0){
    echo "BOOKED";
}else{
    echo "AVAILABLE";
}
?>