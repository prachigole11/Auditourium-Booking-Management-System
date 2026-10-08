<?php
$conn = new mysqli("localhost","root","","hall_booking");

$search = $_GET['organizer'] ?? '';

$query = "
SELECT id, hall_name, event_name, organizer_name,
       booking_date, time_slot, status
FROM hall_bookings
WHERE organizer_name LIKE '%$search%'
ORDER BY booking_date DESC
";

$bookings = $conn->query($query);

// summary counts
$total = $conn->query("SELECT COUNT(*) c FROM hall_bookings")->fetch_assoc()['c'];
$cancelled = $conn->query("SELECT COUNT(*) c FROM hall_bookings WHERE status='Cancelled'")->fetch_assoc()['c'];
$active = $total - $cancelled;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cancel Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:linear-gradient(135deg,#0b2c4d,#1c4f91);
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
        .summary-box{
            background:rgba(255,255,255,.18);
            border-radius:14px;
            padding:20px;
            color:#fff;
            text-align:center;
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
        .badge-booked{background:#28a745;}
        .badge-cancelled{background:#dc3545;}
        .info-box{
            background:rgba(255,255,255,.15);
            border-radius:14px;
            padding:20px;
            color:#fff;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title">
            <i class="bi bi-x-octagon-fill"></i>
            Cancel Booking
        </h2>

        <a href="dashboard.php" class="btn btn-light rounded-pill">
            ← Dashboard
        </a>
    </div>

    <!-- SUMMARY -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="summary-box">
                <small>Total Bookings</small>
                <h3><?php echo $total; ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-box">
                <small>Active Bookings</small>
                <h3><?php echo $active; ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-box">
                <small>Cancelled Bookings</small>
                <h3><?php echo $cancelled; ?></h3>
            </div>
        </div>
    </div>

    <!-- SEARCH -->
    <form class="mb-4">
        <input type="text"
               name="organizer"
               value="<?php echo htmlspecialchars($search); ?>"
               class="form-control form-control-lg"
               placeholder="Search by Organizer Name..."
               onkeyup="this.form.submit()">
    </form>

    <!-- BOOKINGS TABLE -->
    <div class="glass mb-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Organizer</th>
                        <th>Event</th>
                        <th>Hall</th>
                        <th>Date</th>
                        <th>Slot</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = $bookings->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $row['organizer_name']; ?></td>
                        <td><?php echo $row['event_name']; ?></td>
                        <td><?php echo ucfirst($row['hall_name']); ?></td>
                        <td><?php echo $row['booking_date']; ?></td>
                        <td><?php echo ucfirst($row['time_slot']); ?></td>
                        <td>
                            <span class="badge
                            <?php echo $row['status']=='Cancelled'
                                ? 'badge-cancelled'
                                : 'badge-booked'; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td>
                            <?php if($row['status']!='Cancelled'){ ?>
                                <a href="cancel_action.php?id=<?php echo $row['id']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Cancel this booking?')">
                                   Cancel
                                </a>
                            <?php } else { ?>
                                <span class="text-light opacity-75">—</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- INFO SECTION -->
    <div class="info-box">
        <h6><i class="bi bi-info-circle"></i> Cancellation Guidelines</h6>
        <ul class="mb-0">
            <li>Only active bookings can be cancelled.</li>
            <li>Cancelled bookings remain in event history.</li>
            <li>Once cancelled, the hall becomes available.</li>
            <li>Organizer name helps in quick search.</li>
        </ul>
    </div>

</div>

</body>
</html>