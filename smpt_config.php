<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

function sendApprovalEmail($to, $name, $status) {

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'collegeauditorium53@gmail.com';   // 🔴 CHANGE THIS
        $mail->Password   = 'tilijanbxnxdlnev';     // 🔴 CHANGE THIS
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email settings
        $mail->setFrom('collegeauditorium53@gmail.com', 'Hall Booking System');
        $mail->addAddress($to, $name);

        $mail->isHTML(true);

        if ($status === 'approved') {
            $mail->Subject = 'Account Approved';
            $mail->Body = "
                <p>Hello <b>$name</b>,</p>
                <p>Your account has been <b style='color:green;'>APPROVED</b>.</p>
                <p>You can now login using your email and the password you created.</p>
                <p><a href='http://localhost/hall_booking/index.php'>Login Here</a></p>
                <br>
                <p>Regards,<br>College Auditorium Team</p>
            ";
        } else {
            $mail->Subject = 'Account Request Denied';
            $mail->Body = "
                <p>Hello <b>$name</b>,</p>
                <p>Your account request has been <b style='color:red;'>DENIED</b>.</p>
                <p>Please contact the administrator.</p>
                <br>
                <p>College Auditorium Team</p>
            ";
        }

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}