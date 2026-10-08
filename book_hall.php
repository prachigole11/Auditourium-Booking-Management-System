<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Hall</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

/* PAGE HEADER */
.page-header{
    background:#0b2c4d;
    color:#fff;
    padding:30px;
    border-radius:12px;
    margin-bottom:30px;
}

/* HALL CARD */
.hall-card{
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 12px 28px rgba(0,0,0,0.08);
    transition:all .3s ease;
    height:100%;
}
.hall-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 36px rgba(0,0,0,0.15);
}
.hall-card img{
    height:220px;
    width:100%;
    object-fit:cover;
}
.hall-body{
    padding:22px;
    text-align:center;
}
.hall-body h5{
    color:#0b2c4d;
    font-weight:600;
    margin-bottom:6px;
}
.hall-body p{
    font-size:14px;
    color:#666;
}
.btn-view{
    background:#0b2c4d;
    color:#fff;
    border-radius:8px;
    padding:10px;
    font-weight:500;
}
.btn-view:hover{
    background:#09335f;
}
</style>
</head>

<body>

<div class="container py-5">

    <div class="page-header text-center">
        <h3>College Hall Booking</h3>
        <p class="mb-0">Select a hall to view details and proceed with booking</p>
    </div>

    <div class="row g-4">

        <!-- Mahatma Hall -->
        <div class="col-md-4">
            <div class="hall-card">
                <img src="assets/mahatma.png">
                <div class="hall-body">
                    <h5>Mahatma Hall</h5>
                    <p>Large capacity hall suitable for seminars & conferences</p>
                    <a href="hall_details.php?hall=mahatma" class="btn btn-view w-100 mt-3">
                        View Details
                    </a>
                </div>
            </div>
        </div>

        <!-- Jijau Hall -->
        <div class="col-md-4">
            <div class="hall-card">
                <img src="assets/Screenshot 2026-04-18 131541.png">
                <div class="hall-body">
                    <h5>Jijau Hall</h5>
                    <p>Ideal for workshops and academic programs</p>
                    <a href="hall_details.php?hall=jijau" class="btn btn-view w-100 mt-3">
                        View Details
                    </a>
                </div>
            </div>
        </div>

        <!-- Savitri Hall -->
         <div class="col-md-4">
            <div class="hall-card">
                <img src="assets/Screenshot 2026-04-18 131723.png">
                <div class="hall-body">
                    <h5>Savitri Hall</h5>
                    <p>Compact hall for meetings and focused sessions</p>
                    <a href="hall_details.php?hall=savitri" class="btn btn-view w-100 mt-3">
                        View Details
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>