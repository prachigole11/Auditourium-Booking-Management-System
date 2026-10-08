<?php
$hall = $_GET['hall'];

$halls = [
    "mahatma" => [
        "name" => "Mahatma Hall",
        "capacity" => "100– 120",
        "room" => "Room No. 54",
        "features" => [
            "High Quality Projector",
            "Smart Board Facility",
            "Air Conditioned Hall",
            "Flexible Seating Arrangement",
            "Suitable for Seminars & Conferences"
        ]
    ],
    "jijau" => [
        "name" => "Jijau Hall",
        "capacity" => "100 –150",
        "room" => "Room No. 66",
        "features" => [
            "HD Projector",
            "Sound System",
            "Air Conditioned",
            "Ideal for Academic Programs",
            "Comfortable Seating"
        ]
    ],
    "savitri" => [
        "name" => "Savitri Hall",
        "capacity" => "80 – 100",
        "room" => "Room No. 5",
        "features" => [
            "Projector Facility",
            "Sound System",
            "Air Conditioned",
            "Best for Workshops",
            "Quiet Environment"
        ]
    ]
];

$data = $halls[$hall];
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $data['name']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f1f3f6;
    font-family:'Segoe UI',sans-serif;
}

.page-header{
    background:#0b2c4d;
    color:#fff;
    padding:22px 30px;
}

.section-card{
    background:#fff;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    padding:25px;
    margin-bottom:25px;
}

.label{
    font-size:13px;
    color:#666;
}

.value{
    font-weight:600;
    font-size:16px;
}

.feature-item{
    padding:8px 0;
    border-bottom:1px solid #eee;
}

.book-btn{
    background:#0b2c4d;
    color:#fff;
    padding:14px;
    font-weight:600;
    border-radius:8px;
}
.book-btn:hover{
    background:#09335f;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="page-header">
    <h3 class="mb-0"><?php echo $data['name']; ?> – Hall Information</h3>
</div>

<div class="container py-4">

    <!-- BASIC INFO -->
    <div class="section-card">
        <div class="row">
            <div class="col-md-4">
                <div class="label">Hall Name</div>
                <div class="value"><?php echo $data['name']; ?></div>
            </div>
            <div class="col-md-4">
                <div class="label">Seating Capacity</div>
                <div class="value"><?php echo $data['capacity']; ?> Persons</div>
            </div>
            <div class="col-md-4">
                <div class="label">Room Number</div>
                <div class="value"><?php echo $data['room']; ?></div>
            </div>
        </div>
    </div>

    <!-- FACILITIES -->
    <div class="section-card">
        <h5 class="mb-3">Available Facilities</h5>
        <?php foreach($data['features'] as $f){ ?>
            <div class="feature-item"><?php echo $f; ?></div>
        <?php } ?>
    </div>

    <!-- BOOKING STATUS (FUTURE READY) -->
    <div class="section-card">
        <h5 class="mb-3">Booking Status</h5>
        <p class="text-muted mb-0">
            Hall availability is checked automatically based on selected date and time slot during booking.
        </p>
    </div>

    <!-- ACTION -->
    <div class="section-card text-end">
        <a href="book_form.php?hall=<?php echo $hall; ?>" class="btn book-btn">
            Proceed to Book Hall
        </a>
    </div>

</div>

</body>
</html>