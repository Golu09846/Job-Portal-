<?php
include('includes/db.php');

$errors = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['fullname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $usertype = $_POST['usertype'];
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirm = mysqli_real_escape_string($conn, $_POST['confirm_password']);

  if ($password !== $confirm) {
    $errors = "Passwords do not match.";
  } else {
    // Check if email already exists
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $errors = "Email is already registered.";
    } else {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $created_at = date('Y-m-d H:i:s');

      $sql = "INSERT INTO users (name, email, password, phone, resume, created_at)
              VALUES ('$name', '$email', '$hashed_password', '$phone', '', '$created_at')";

      if (mysqli_query($conn, $sql)) {
        $success = "Registration successful! Redirecting to login...";
        echo "<script>
                setTimeout(function() {
                  window.location.href = 'login.php';
                }, 2000);
              </script>";
      } else {
        $errors = "Something went wrong. Please try again.";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | Job Portal</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(145deg, #0f2027, #203a43, #2c5364);
      background-attachment: fixed;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
      position: relative;
    }
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('https://www.transparenttextures.com/patterns/stardust.png');
      opacity: 0.04;
      z-index: 0;
    }
    #register {
      width: 100%;
      padding: 100px 20px;
      z-index: 2;
    }
    .register-box {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 40px;
      backdrop-filter: blur(20px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
      color: #ffffff;
      max-width: 650px;
      margin: auto;
      animation: fadeIn 1s ease forwards;
      transform: translateY(30px);
      opacity: 0;
    }
    @keyframes fadeIn {
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
    h2 {
      font-weight: 600;
      color: #ffffff;
      margin-bottom: 30px;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
    }
    label {
      color: #b2ebf2;
      font-weight: 500;
    }
    .form-control {
      background-color: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      border-radius: 12px;
    }
    .form-control::placeholder {
      color: #d0e7f5;
    }
    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      border-color: #00e5ff;
      box-shadow: 0 0 12px rgba(0, 229, 255, 0.5);
    }
    .btn-primary {
      background: linear-gradient(to right, #00e5ff, #00bcd4);
      border: none;
      font-weight: 600;
      border-radius: 12px;
      padding: 10px 15px;
    }
    .btn-primary:hover {
      background: linear-gradient(to right, #00bcd4, #00e5ff);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 229, 255, 0.4);
    }
    .footer {
      background-color: #111;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      width: 100%;
      position: relative;
      z-index: 2;
    }
  </style>
</head>

<body>
  <?php include('includes/navbar.php'); ?>

  <section id="register">
    <div class="register-box">
      <h2 class="text-center">Create Your Account</h2>

      <!-- Show success or error messages -->
      <?php if ($errors): ?>
        <div class="alert alert-danger"><?php echo $errors; ?></div>
      <?php elseif ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
      <?php endif; ?>

      <form action="" method="POST">
        <div class="form-group">
          <label for="fullname">Full Name</label>
          <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required />
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required />
        </div>
        <div class="form-group">
          <label for="usertype">User Type</label>
          <select class="form-control" id="usertype" name="usertype" required>
            <option value="" disabled selected>Select user type</option>
            <option value="jobseeker">Job Seeker</option>
            <option value="employer">Employer</option>
          </select>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required />
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required />
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-3">Register</button>
      </form>
      <p class="mt-4 text-center">Already have an account? <a href="login.php">Login Here</a></p>
    </div>
  </section>

  <footer class="footer">
    <p>&copy; 2025 JobPortal. All Rights Reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
