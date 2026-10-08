<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); 

// $conn = new mysqli("localhost", "No", "", "hall_booking");
$conn = new mysqli("localhost", "root", "", "hall_booking");
if ($conn->connect_error) {
    die("DB Connection Failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, name, email, password, role, status FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // ✅ EMAIL FOUND
    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // ✅ PASSWORD CHECK
        if (password_verify($password, $user['password'])) {

            // 🔒 STATUS CHECK
            // 🔒 STATUS CHECK ONLY FOR USERS
    //      if ($user['role'] === 'user' && $user['status'] !== 'approved') {
    //      echo "<script>alert('Your account is not approved yet'); window.location.href='index.php';</script>";
    //      exit();
    //    }
    // 🔒 CHECK STATUS
if($user['role'] === 'admin') {
    // Admin always approved
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name']    = $user['name'];
    $_SESSION['email']   = $user['email'];
    $_SESSION['role']    = $user['role'];
    header("Location: dashboard.php");
    exit();
} elseif ($user['status'] === 'approved') {
    // Approved user
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name']    = $user['name'];
    $_SESSION['email']   = $user['email'];
    $_SESSION['role']    = $user['role'];
    header("Location: dashboard.php");
    exit();
} elseif ($user['status'] === 'pending') {
    echo "<script>alert('Your account is pending admin approval'); window.location.href='index.php';</script>";
    exit();
} elseif ($user['status'] === 'denied') {
    echo "<script>alert('Your account has been denied by admin'); window.location.href='index.php';</script>";
    exit();
}

            // ✅ SESSION SET
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name']    = $user['name'];
            $_SESSION['email']   = $user['email'];
            $_SESSION['role']    = $user['role'];

            header("Location: dashboard.php");
            exit();

        } else {
            // ❌ PASSWORD WRONG
            echo "<script>alert('Invalid password'); window.location.href='index.php';</script>";
            exit();
        }

    } else {
        // ❌ EMAIL NOT FOUND
        echo "<script>alert('Email not found'); window.location.href='index.php';</script>";
        exit();
    }
}
?>