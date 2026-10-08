<?php
$conn = new mysqli("localhost","root","","hall_booking");

$today = date('Y-m-d');

$events = $conn->query("
    SELECT hall_name, event_name, organizer_name,
           booking_date, time_slot, status
    FROM hall_bookings
    WHERE booking_date = '$today'
    ORDER BY time_slot ASC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Today's Events</title>

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
            letter-spacing:.5px;
        }
        table th,table td{
            border:1px solid rgba(255,255,255,.35);
            color:#fff;
            padding:14px;
        }
        thead{
            background:rgba(255,255,255,.25);
        }
        tbody tr:hover{
            background:rgba(255,255,255,.12);
        }
        .badge-booked{
            background:#28a745;
        }
        .badge-cancelled{
            background:#dc3545;
        }
        .empty-box{
            color:#fff;
            text-align:center;
            padding:60px;
            opacity:.85;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title">
            <i class="bi bi-calendar-check-fill"></i>
            Today’s Events (<?php echo date('d M Y'); ?>)
        </h2>

        <a href="dashboard.php" class="btn btn-light rounded-pill">
            ← Dashboard
        </a>
    </div>

    <!-- CONTENT -->
    <div class="glass">

        <?php if($events->num_rows > 0){ ?>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Time Slot</th>
                        <th>Hall</th>
                        <th>Event Name</th>
                        <th>Organizer</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = $events->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo ucfirst($row['time_slot']); ?></td>
                        <td><?php echo ucfirst($row['hall_name']); ?></td>
                        <td><?php echo $row['event_name']; ?></td>
                        <td><?php echo $row['organizer_name']; ?></td>
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

        <?php } else { ?>

            <div class="empty-box">
                <i class="bi bi-emoji-smile" style="font-size:40px;"></i>
                <h5 class="mt-3">No events scheduled for today</h5>
            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>