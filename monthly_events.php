<?php
$conn = new mysqli("localhost","root","","hall_booking");

$month = $_GET['month'] ?? date('Y-m');

$events = $conn->query("
    SELECT hall_name, event_name, organizer_name,
           booking_date, time_slot, status
    FROM hall_bookings
    WHERE DATE_FORMAT(booking_date,'%Y-%m') = '$month'
    ORDER BY booking_date ASC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Monthly Event Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#0b2c4d,#1c4f91);
            font-family:'Segoe UI',sans-serif;
            min-height:100vh;
        }
        .wrapper{
            padding:50px;
        }
        .glass{
            background:rgba(255,255,255,.12);
            backdrop-filter:blur(12px);
            border-radius:20px;
            padding:30px;
            box-shadow:0 25px 50px rgba(0,0,0,.25);
        }
        .title{
            color:#fff;
            font-weight:700;
        }
        
        .table-structure th,
        .table-structure td {
          border: 1px solid #000;
          padding: 14px;
          color: #fff;
        }

.table-structure thead th {
    background: rgba(255,255,255,.25);
}
        thead{
            background:rgba(255,255,255,.25);
        }
        .badge-booked{
            background:#28a745;
        }
        .badge-cancelled{
            background:#dc3545;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title">
            <i class="bi bi-calendar-month"></i>
            Monthly Event Details
        </h2>

        <a href="dashboard.php" class="btn btn-light rounded-pill">
            ← Dashboard
        </a>
    </div>

    <!-- MONTH SELECT -->
    <form class="mb-4">
        <input type="month"
               name="month"
               value="<?php echo $month; ?>"
               class="form-control w-25"
               onchange="this.form.submit()">
    </form>

    <!-- TABLE -->
    <div class="glass">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Hall</th>
                        <th>Event</th>
                        <th>Organizer</th>
                        <th>Time Slot</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = $events->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $row['booking_date']; ?></td>
                        <td><?php echo ucfirst($row['hall_name']); ?></td>
                        <td><?php echo $row['event_name']; ?></td>
                        <td><?php echo $row['organizer_name']; ?></td>
                        <td><?php echo ucfirst($row['time_slot']); ?></td>
                        <td>
                            <span class="badge 
                            <?php echo $row['status']=='Cancelled'
                                  ? 'badge-cancelled'
                                  : 'badge-booked'; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>