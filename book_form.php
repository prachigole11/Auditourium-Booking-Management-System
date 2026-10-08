<?php
$hall = $_GET['hall'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hall Booking</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    background:
      linear-gradient(rgba(11,44,77,0.85), rgba(11,44,77,0.85)),
      url("college_bg.jpg") center/cover no-repeat;
    font-family:'Segoe UI', sans-serif;
}

/* MAIN CARD */
.main-card{
    max-width:1100px;
    margin:auto;
    background:rgba(255,255,255,0.95);
    border-radius:22px;
    box-shadow:0 30px 70px rgba(0,0,0,0.35);
    overflow:hidden;
}

/* LEFT PANEL */
.left-panel{
    background:linear-gradient(160deg,#0b2c4d,#144b7a);
    color:#fff;
    padding:50px 40px;
    height:100%;
}

.left-panel h2{
    font-weight:700;
}

.left-panel p{
    opacity:0.9;
    margin-top:15px;
    line-height:1.7;
}

.hall-badge{
    background:rgba(255,255,255,0.15);
    padding:12px 18px;
    border-radius:12px;
    display:inline-block;
    margin-top:25px;
    font-weight:600;
}

/* RIGHT PANEL */
.form-panel{
    padding:45px;
}

.form-label{
    font-weight:600;
    color:#333;
}

.form-control, .form-select{
    height:50px;
    border-radius:12px;
}

textarea.form-control{
    height:100px;
}

.btn-confirm{
    background:linear-gradient(135deg,#0b2c4d,#1f7bc4);
    color:#fff;
    border:none;
    font-size:18px;
    font-weight:600;
    padding:14px;
    border-radius:14px;
}

.btn-confirm:hover{
    opacity:0.95;
}
</style>
</head>

<!-- new from here -->
<script>
const dateInput = document.querySelector('[name="booking_date"]');
const slotInput = document.querySelector('[name="time_slot"]');
const statusMsg = document.getElementById('statusMsg');

function checkAvailability(){
    if(dateInput.value && slotInput.value){
        const formData = new FormData();
        formData.append("hall","<?php echo $hall; ?>");
        formData.append("date",dateInput.value);
        formData.append("slot",slotInput.value);

        fetch("check_availability.php",{
            method:"POST",
            body:formData
        })
        .then(res => res.text())
        .then(data=>{
            if(data === "BOOKED"){
                statusMsg.innerHTML = "❌ Hall already booked for selected date & slot";
                statusMsg.style.color = "red";
            }else{
                statusMsg.innerHTML = "✅ Hall available";
                statusMsg.style.color = "green";
            }
        });
    }
}

dateInput.addEventListener("change",checkAvailability);
slotInput.addEventListener("change",checkAvailability);
</script>
<body>

<div class="container py-5">

    <div class="main-card">
        <div class="row g-0">

            <!-- LEFT INFO -->
            <div class="col-md-5 left-panel">
                <h2><i class="bi bi-building"></i> Hall Booking</h2>

                <p>
                    Vidya Pratishthan Arts, Science & Commerce College uses
                    this system for official academic & institutional events.
                </p>

                <div class="hall-badge">
                    Selected Hall: <?php echo ucfirst($hall); ?>
                </div>

                <p class="mt-4">
                    <i class="bi bi-check-circle"></i> Real-time availability<br>
                    <i class="bi bi-check-circle"></i> Secure booking records<br>
                    <i class="bi bi-check-circle"></i> Admin verified system
                </p>
            </div>

            <!-- RIGHT FORM -->
            <div class="col-md-7 form-panel">

                <h4 class="mb-4 fw-bold text-primary">
                    <i class="bi bi-pencil-square"></i> Event Details
                </h4>

                <form method="POST" action="check_booking.php">

                    <input type="hidden" name="hall" value="<?php echo $hall; ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Event Name</label>
                            <input type="text" name="event_name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Organizer Name</label>
                            <input type="text" name="organizer_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Event Purpose</label>
                        <textarea name="event_purpose" class="form-control" required></textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Event Date</label>
                            <input type="date" name="booking_date" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Time Slot</label>
                            <select name="time_slot" class="form-select" required>
                                <option value="">Select Slot</option>
                                <option>Morning</option>
                                <option>Afternoon</option>
                                <option>Evening</option>
                                <option>Full Day</option>
                            </select>
                                <!-- new abaibility msg -->
                            <div id="statusMsg" class="mt-2 fw-semibold"></div>     
                        </div>
                    </div>

                    <button class="btn btn-confirm w-100">
                        <i class="bi bi-calendar-check"></i> Confirm Booking
                    </button>

                </form>

            </div>
        </div>
    </div>

</div>

</body>
</html>