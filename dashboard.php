<?php
session_start();
$role=$_SESSION['role'];
 
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} 
// ✅ Database connection
$conn = new mysqli("localhost", "root", "", "hall_booking");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>




<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Hall Booking System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background-color: #0b2c4d;
            padding: 12px 20px;
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-brand img {
            height: 40px;
            background: #fff;
            padding: 4px;
            border-radius: 6px;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 500;
            margin-right: 10px;
        }

        /* DASHBOARD */
        .dashboard-container {
            padding: 40px;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(0,0,0,0.15);
        }

        .dashboard-card i {
            font-size: 40px;
            color: #0b2c4d;
            margin-bottom: 15px;
        }

        .dashboard-card h5 {
            font-weight: 600;
            color: #0b2c4d;
        }

        .dashboard-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 0;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <!-- <img src="COLLEGE_LOGO_URL_HERE"> -->
            Auditorium Booking system
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <!-- from here -->
              <?php if ($role === 'admin'): ?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-warning" data-bs-toggle="dropdown" style="font-weight:600;">
        <i class="bi bi-shield-check"></i> admin panel
    </a>
    <ul class="dropdown-menu dropdown-menu-end p-2" style="width: 380px; max-height: 400px; overflow-y:auto;">
        <li class="dropdown-header fw-bold">pending users</li>
        <?php
        // fetch pending users
        $pending = $conn->query("select id, name, email from users where status='pending'");
        if($pending->num_rows > 0) {
            while($row = $pending->fetch_assoc()){
                echo '<li class="d-flex justify-content-between align-items-center p-2 mb-1 border rounded shadow-sm bg-light">';
                echo '<div>';
                echo '<strong>'.$row['name'].'</strong><br><small class="text-muted">'.$row['email'].'</small>';
                echo '</div>';
                echo '<div class="d-flex gap-1">';
                echo '<a href="approve_user.php?id='.$row['id'].'" class="btn btn-success btn-sm">approve</a>';
                echo '<a href="deny_user.php?id='.$row['id'].'" class="btn btn-danger btn-sm">deny</a>';
                echo '</div>';
                echo '</li>';
            }
        } else {
            echo '<li class="text-center text-muted p-2">no pending users</li>';
        }
        ?>
    </ul>
</li>
<?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        Total Halls
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item">Mahatma Auditorium</a></li>
                        <li><a class="dropdown-item">Jijau Auditorium</a></li>
                        <li><a class="dropdown-item">Savitri Auditorium</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link">Available Halls</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link">Booked Today</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-warning" onclick="confirmLogout()">Logout</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- DASHBOARD CONTENT -->
<div class="dashboard-container">
    <div class="row g-4">

        <!-- FIRST ROW -->
        <div class="col-md-6">
           
            <div class="dashboard-card" onclick="window.location.href='book_hall.php'" style="cursor: pointer;">
                 <!-- <a href="book_hall.php" class="d-block text-decoration: none;"> -->
                <i class="bi bi-building-check"></i>
                <h5>Book Hall</h5>
                
                <p>Book college halls with date and time slot</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="dashboard-card" onclick="window.location.href='today_events.php'">
                <i class="bi bi-calendar-event"></i>
                <h5>Today’s Events</h5>
                <p>View all events scheduled for today</p>
            </div>
        </div>

        <!-- SECOND ROW -->
        <div class="col-md-6">
            <div class="dashboard-card" onclick="window.location.href='monthly_events.php'">
                <i class="bi bi-calendar-week"></i>
                <h5>Weekly Events</h5>
                <p>Check weekly hall booking overview</p>
            </div>
        </div> 
                  <!-- php if ($role === 'admin'): ?>
             <div class="col-md-6">
               <div class="dashboard-card" onclick="window.location.href='monthly_events.php'">
                 <i class="bi bi-calendar-week"></i>
               <h5>Weekly Events</h5>
                  <p>Check weekly hall booking overview</p>
              </div>
                 </div>
                   -->


             <div class="col-md-6">
                  <div class="dashboard-card" onclick="window.location.href='event_history.php'">
                     <i class="bi bi-clock-history"></i>
                     <h5>Event History</h5>
                     <p>View complete hall booking history</p>
                  </div>
               </div> 
          <!-- if ($role === 'admin'): ?>
          <div class="col-md-6">
               <div class="dashboard-card" onclick="window.location.href='event_history.php'">
                  <i class="bi bi-clock-history"></i>
                    <h5>Event History</h5>
                  <p>View complete hall booking history</p>
                </div>
          </div>
           ; ?> -->





        <div class="row g-4">
            <!-- new Paste -->
            
            <div class="col-md-6">
                <a href="cancel_booking.php" class="text-decoration-none text-dark">
                  <div class="dashboard-card"
                       onclick="window.location.href='cancel_booking.php'">
                     <i class="bi bi-x-octagon-fill"></i>
                     <h5>Cancel Booking</h5>
                      <p>Cancel an existing hall booking</p>
                     </div>
                </a>
        </div>

        <div class="col-md-6">
           <a href="feedback.php" class="text-decoration-none text-dark">
              <div class="dashboard-card"
                 onclick="window.location.href='review.php'">
                 <i class="bi bi-chat-dots-fill"></i>
                 <h5>Review & Feedback</h5>
                  <p>View feedback and event reviews</p>
                </div>
            </a>
        </div>
       
    </div>

<!-- Logout Confirmation -->
<script>
function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.href = "logout.php";
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

