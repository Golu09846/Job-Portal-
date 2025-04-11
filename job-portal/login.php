<?php
session_start();
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: applications.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Job Portal</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      background-size: cover;
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    #login {
      background: rgba(0, 0, 0, 0.6);
      padding: 60px 30px;
      border-radius: 15px;
      margin-top: 60px;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
    }

    h2 {
      font-weight: 600;
      color: #e0d9ff;
      text-shadow: 0 0 10px rgba(150, 100, 255, 0.5);
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-primary {
      background-color: #00bcd4;
      border: none;
      padding: 10px 30px;
      border-radius: 25px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0097a7;
    }

    .footer {
      background-color: rgba(0, 0, 0, 0.85);
      text-align: center;
      padding: 20px;
      color: #fff;
      margin-top: auto;
    }

    .form-check-label {
      color: #ccc;
    }

    .extra-links {
      text-align: center;
      margin-top: 15px;
    }

    .extra-links a {
      color: #80deea;
      text-decoration: none;
    }

    .extra-links a:hover {
      text-decoration: underline;
    }

    .alert-danger {
      margin-top: 15px;
    }
  </style>
</head>

<body>

  <?php include('includes/navbar.php'); ?>

  <section id="login">
    <div class="container">
      <h2 class="text-center mb-4">Login to Your Account</h2>
      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
      <?php endif; ?>
      <form method="POST">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="e.g. yourname@example.com" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group form-check d-flex justify-content-between">
          <div>
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
          </div>
          <a href="#" class="text-light small">Forgot Password?</a>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
      <div class="extra-links">
        <p class="mt-3">Don't have an account? <a href="register.php">Register Here</a></p>
      </div>
    </div>
  </section>

  <footer class="footer">
    <p>&copy; 2025 JobPortal. All Rights Reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
