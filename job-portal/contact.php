<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us | Job Portal</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('https://www.bacancytechnology.com/main/img/job-recruitment-portal-development/form-bg.jpg?v-1') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }



    .contact-section {
      background: rgba(0, 0, 0, 0.55);
      backdrop-filter: blur(10px);
      padding: 60px 30px;
      border-radius: 20px;
      max-width: 1000px;
      margin: 80px auto;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    }

    h2 {
      text-align: center;
      margin-bottom: 40px;
      font-weight: 600;
      color: #e0e7ff;
      text-shadow: 0 0 8px rgba(150, 200, 255, 0.5);
    }

    label {
      color: #dcdcdc;
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #fff;
    }

    .form-control::placeholder {
      color: #ccc;
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.12);
      color: #fff;
      box-shadow: none;
    }

    .btn-primary {
      background-color: #4e8ef7;
      border: none;
      border-radius: 30px;
      padding: 10px 30px;
      font-weight: 500;
    }

    .btn-primary:hover {
      background-color: #3478f6;
    }

    .info-box {
      margin-top: 40px;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
      color: #e5e5e5;
    }

    .info-item {
      text-align: center;
    }

    .info-item i {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #66c2ff;
    }

    .map-container {
      width: 100%;
      height: 300px;
      border-radius: 16px;
      overflow: hidden;
      margin-top: 50px;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    footer {
      background-color: rgba(0, 0, 0, 0.85);
      text-align: center;
      padding: 20px;
      color: #fff;
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .contact-section {
        padding: 40px 20px;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <?php include('includes/navbar.php'); ?>

  <!-- Contact Section -->
  <section class="contact-section">
    <h2>Contact Us</h2>
    <form action="#" method="POST">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name">Full Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
        </div>
      </div>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" rows="4" placeholder="Your message" required></textarea>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary mt-3">Send Message</button>
      </div>
    </form>

    <!-- Additional Contact Info -->
    <div class="info-box mt-5">
      <div class="info-item">
        <i class="fas fa-envelope"></i>
        <p>shahabdulla09856@gmail.com</p>
      </div>
      <div class="info-item">
        <i class="fas fa-phone-alt"></i>
        <p>+91 9569228384</p>
      </div>
      <div class="info-item">
        <i class="fas fa-map-marker-alt"></i>
        <p>St. Andrews Institute of Technology and Management</p>
      </div>
    </div>

    <!-- Google Maps Embed -->
    <div class="map-container">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.3300259574434!2d76.7633045!3d28.4480418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d6bb18c31279b%3A0x11d335a5bc228dd6!2sSt.%20Andrews%20Institute%20of%20Technology%20and%20Management!5e0!3m2!1sen!2sin!4v1682158438167!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 JobPortal. All Rights Reserved.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
