<?php
$conn = new mysqli("localhost","root","","hall_booking");

$hall = $_POST['hall'];
$event_name = $_POST['event_name'];
$event_purpose = $_POST['event_purpose'];
$organizer = $_POST['organizer_name'];
$date = $_POST['booking_date'];
$slot = $_POST['time_slot'];

/* Check availability */
$check = $conn->prepare(
    "SELECT * FROM hall_bookings 
     WHERE hall_name=? AND booking_date=? AND time_slot=?"
);
$check->bind_param("sss",$hall,$date,$slot);
$check->execute();
$result = $check->get_result();

if($result->num_rows > 0){
    echo "
    <div style='padding:40px;font-family:Segoe UI'>
        <h3 style='color:red'>Hall Not Available ❌</h3>
        <p>The selected hall is already booked for:</p>
        <b>Date:</b> $date <br>
        <b>Time Slot:</b> $slot <br><br>
        <a href='book_form.php?hall=$hall'>Go Back</a>
    </div>";
}
else{
    $insert = $conn->prepare(
        "INSERT INTO hall_bookings 
        (hall_name,event_name,event_purpose,organizer_name,booking_date,time_slot)
        VALUES (?,?,?,?,?,?)"
    );
    $insert->bind_param("ssssss",$hall,$event_name,$event_purpose,$organizer,$date,$slot);
    $insert->execute();

    echo "
    <div style='padding:40px;font-family:Segoe UI'>
        <h3 style='color:green'>Booking Successful ✅</h3>
        <p>Your hall has been booked successfully.</p>
        <b>Hall:</b> $hall <br>
        <b>Date:</b> $date <br>
        <b>Time Slot:</b> $slot <br><br>
        <a href='dashboard.php'>Go to Dashboard</a>
    </div>";
}
?>