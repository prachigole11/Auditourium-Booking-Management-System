<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>College Hall Booking System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
             min-height: 100vh;
            padding: 0;
            
            margin: 0; 
            background: 
                linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), 
                url("assets/thired.png") no-repeat center center/cover; 
        }
        

        /* NAVBAR */
        html,body{
            height: 100%;
            width: 100%;
            margin: 0;

        }
        .navbar {
            background: rgba(11, 44, 77, 0.95);
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
            height: 48px;
            width: auto;
            background: #fff;
            padding: 4px;
            border-radius: 6px;
        }

        /* LOGIN AREA */
        .login-wrapper {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            width: 420px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            overflow: hidden;
        }

        .login-card-header {
            padding: 22px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e5e5e5;
            text-align: center;
        }

        .login-card-header h5 {
            margin: 0;
            color: #0b2c4d;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            height: 46px;
            border-radius: 6px;
        }

        .btn-login {
            background-color: #0b2c4d;
            color: #fff;
            font-weight: 600;
            height: 46px;
            border-radius: 6px;
            border: none;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            background-color: #09335f;
        }

        .footer-text {
            font-size: 13px;
            color: #777;
            text-align: center;
            margin-top: 18px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <!-- 🔽 Paste College Logo Link -->
            <img src="https://is4-ssl.mzstatic.com/image/thumb/Purple112/v4/b5/97/f1/b597f193-43e8-d2bd-1292-2e2fa09afb6d/AppIcon-0-0-1x_U007emarketing-0-0-0-7-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/512x512bb.jpg" alt="College Logo">
            Vidya Pratishthan Arts, Science & Commerce College, Baramati
        </a>
    </div>
</nav>

<!-- LOGIN SECTION -->
<div class="login-wrapper">
    <div class="login-card">
        <div class="login-card-header">
            <h5>Admin Login</h5>
        </div>

        <div class="p-4">
            <form action="login.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Username / Email</label>
                    <input type="email" name="email" class="form-control"
                           placeholder="admin@college.com" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    Login
                </button>
            </form>

            <div class="footer-text">
                © 2026 Vidya Pratishthan College
            </div>
        </div>
    </div>
</div>

</body>
</html>