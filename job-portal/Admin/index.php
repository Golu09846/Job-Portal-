<?php
session_start();
include 'includes/db.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: pages/dashboard.php');
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Plain password match (since you're not using hashing)
        if ($password === $admin['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_id'] = $admin['admin_id'];
            header('Location: pages/dashboard.php');
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Admin not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.09);
            backdrop-filter: blur(15px);
            border-radius: 18px;
            padding: 40px 35px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
            color: #fff;
        }

        .login-box h4 {
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-label {
            color: #e0e0e0;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            box-shadow: none;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #00c6ff);
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #00c6ff, #0d6efd);
            transform: scale(1.02);
        }

        .alert {
            background-color: rgba(220, 53, 69, 0.95);
            border: none;
            color: #fff;
            font-size: 14px;
            text-align: center;
            border-radius: 6px;
        }

        .show-password {
            cursor: pointer;
            color: #ccc;
            transition: color 0.2s;
        }

        .show-password:hover {
            color: #fff;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h4><i class="fas fa-user-shield me-2"></i>Admin Login</h4>

    <?php if (isset($error)) echo '<div class="alert mb-3">' . $error . '</div>'; ?>

    <form method="post" autocomplete="off">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="username" class="form-control" placeholder="Enter admin email" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                <span class="input-group-text show-password" onclick="togglePassword()">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </span>
            </div>
        </div>

        <button type="submit" name="login" class="btn btn-primary w-100">
            <i class="fas fa-sign-in-alt me-1"></i>Login
        </button>
    </form>
</div>

<script>
    function togglePassword() {
        const pwd = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");
        if (pwd.type === "password") {
            pwd.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            pwd.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>
