<!-- <?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
?>

 its new -->



<?php
$conn = new mysqli("localhost","root","","hall_booking");

$events = $conn->query("
    SELECT hall_name, booking_date, time_slot
    FROM hall_bookings
    ORDER BY booking_date DESC
");

$counts = $conn->query("
    SELECT hall_name, COUNT(*) AS total
    FROM hall_bookings
    GROUP BY hall_name
");

$top = $conn->query("
    SELECT hall_name, COUNT(*) AS total
    FROM hall_bookings
    GROUP BY hall_name
    ORDER BY total DESC
    LIMIT 1
")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event History | Analytics</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0b2c4d, #1c4f91);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }
      .table-bordered-custom
       {
          border-collapse: separate;
         border-spacing: 0;
          width: 100%;
        }

        .table-bordered-custom th,
        .table-bordered-custom td 
        {
           border: 1px solid black;    
            /* change */
          padding: 14px;
         color:black;
         }

          .table-bordered-custom thead th {
           background: rgba(255,255,255,0.25);
           font-weight: 600;
            } 
  
          .table-bordered-custom tbody tr:hover
           {
               background: rgba(255,255,255,0.12);
            }

           .page-wrapper {
            padding: 50px;
        }

       .glass
       {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            padding: 30px;
        }
         .table-responsive{
            background-color:white;
            color: black;
         }
        .page-title {
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .stat-card {
            background: rgba(255,255,255,0.18);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            color: #fff;
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            background: rgba(255,255,255,0.25);
        }

        .stat-card i {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .table {
            color: #fff;
        }

        .table thead {
            background: rgba(255,255,255,0.25);
        }

        .table tbody tr {
            transition: .2s;
        }

        .table tbody tr:hover {
            background: rgba(255,255,255,0.15);
        }

        .badge-hall {
            background:rgba(255,255,255,0.25);
            
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            border: 1px;
        }

        .back-btn {
            border: 1px solid rgba(255,255,255,.4);
            color: #fff;
            border-radius: 30px;
            padding: 8px 20px;
            transition: .3s;
        }

        .back-btn:hover {
            background: #fff;
            color: #0b2c4d;
        }
       
    </style>
</head>

<body>

<div class="page-wrapper">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">
            <i class="bi bi-bar-chart-line-fill me-2"></i>
            Event History & Analytics
        </h2>

        <a href="dashboard.php" class="back-btn text-decoration-none">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- STATS -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <i class="bi bi-trophy-fill"></i>
                <div class="small opacity-75">Most Booked Hall</div>
                <h5 class="fw-bold mt-1">
                    <?php echo $top['hall_name'] ?? '—'; ?>
                </h5>
            </div>
        </div>

        <?php while($c = $counts->fetch_assoc()){ ?>
        <div class="col-md-4">
            <div class="stat-card">
                <i class="bi bi-building"></i>
                <div class="small opacity-75">
                    <?php echo ucfirst($c['hall_name']); ?>
                </div>
                <h4 class="fw-bold"><?php echo $c['total']; ?> bookings</h4>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- HISTORY TABLE -->
    <div class="table-responsive">
    <table class="table-bordered-custom align-middle">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Hall</th>
            </tr>
        </thead>
        <tbody>
        <?php while($e = $events->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $e['booking_date']; ?></td>
                <td><?php echo ucfirst($e['time_slot']); ?></td>
                <td>
                    <span class="badge-hall">
                        <?php echo ucfirst($e['hall_name']); ?>
                    </span>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>