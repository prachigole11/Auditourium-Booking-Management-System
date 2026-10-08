<?php
session_start();

// ✅ Only admin can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// ✅ Database connection
$conn = new mysqli("localhost", "root", "", "hall_booking");
if ($conn->connect_error) {
    die("DB Connection Failed");
}

// ✅ Handle Approve / Deny action
if (isset($_GET['action'], $_GET['id'])) {

    $id = (int)$_GET['id'];
    $action = $_GET['action'];
    $status = ($action === 'approve') ? 'approved' : 'denied';

    // ✅ Get user info
    $getUser = $conn->prepare("SELECT email, name FROM users WHERE id=?");
    $getUser->bind_param("i", $id);
    $getUser->execute();
    $user = $getUser->get_result()->fetch_assoc();

    // ✅ Update status in DB
    $stmt = $conn->prepare("UPDATE users SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    // ✅ Send email notification
    $to = $user['email'];
    $subject = ($status === 'approved') ? "Account Approved | Hall Booking System" : "Account Denied | Hall Booking System";

    $message = "
    Hello {$user['name']},

    Your account has been **" . strtoupper($status) . "** by the admin.

    You can " . ($status === 'approved' ? "now login using your email and password." : "not login as your request has been denied.") . "

    Login here:
    http://localhost/hall_booking/index.php

    Regards,
    College Auditorium Team
    ";

    $headers = "From: no-reply@college.com";

    mail($to, $subject, $message, $headers);

    // ✅ Redirect back to approval page
    header("Location: user_approval.php");
    exit();
}

// ✅ Get all pending users
$result = $conn->query("SELECT id, name, email FROM users WHERE role='user' AND status='pending'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Approvals | Hall Booking System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
.container { margin-top: 50px; }
.table thead th { text-align: center; }
.table tbody td { vertical-align: middle; }
.btn-sm { padding: 0.25rem 0.5rem; }
</style>
</head>
<body>
<div class="container">
<h3 class="mb-4">Pending User Approvals</h3>

<?php if ($result->num_rows === 0): ?>
<div class="alert alert-success text-center">No pending user requests.</div>
<?php else: ?>
<table class="table table-bordered table-striped bg-white shadow-sm">
<thead class="table-dark">
<tr>
<th>Name</th>
<th>Email</th>
<th width="250">Action</th>
</tr>
</thead>
<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars($row['name']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td class="text-center">
<a href="?action=approve&id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Approve</a>
<a href="?action=deny&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to deny this user?')">Deny</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<?php endif; ?>

</div>
</body>
</html>