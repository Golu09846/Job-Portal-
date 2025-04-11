<?php
// session_start();
// include 'config/db.php'; // Optional: Only if you want to pull testimonials from DB
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us | Job Portal</title>
  <meta name="description" content="Learn more about JobPortal, a leading platform connecting job seekers with top employers.">
  <meta name="keywords" content="job portal, recruitment, find jobs, hiring, about jobportal">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: url('https://www.bacancytechnology.com/main/img/job-recruitment-portal-development/form-bg.jpg?v-1') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #fff;
    }


    .about-container {
      background: linear-gradient(135deg, rgba(0, 255, 255, 0.33), rgba(0, 85, 128, 0.18), rgba(0, 255, 200, 0.15));
      padding: 60px 40px;
      border-radius: 20px;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
      max-width: 1100px;
      margin: 100px auto;
      text-align: center;
      color: #fff;
      backdrop-filter: blur(14px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .about-container h2 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 30px;
      color: #e0d9ff;
      text-shadow: 0 0 10px rgba(174, 170, 186, 0.5), 0 0 24px rgba(110, 90, 255, 0.4);
    }

    .about-container p {
      font-size: 1.15rem;
      margin-bottom: 20px;
      line-height: 1.7;
    }

    .feature-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 50px;
      gap: 30px;
    }

    .feature-card {
      background: rgba(44, 35, 80, 0.6);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      padding: 20px;
      width: 260px;
      color: #fff;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      backdrop-filter: blur(12px);
    }

    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
    }

    .feature-card img {
      width: 80px;
      height: 80px;
      margin-bottom: 15px;
    }

    .testimonial-section {
      margin-top: 80px;
    }

    .testimonial {
      background-color: rgba(44, 35, 80, 0.6);
      padding: 30px;
      border-radius: 16px;
      margin: 20px auto;
      max-width: 800px;
      font-style: italic;
      font-size: 1.1rem;
      color: #ffffff;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
    }

    .testimonial::before {
      content: "“";
      font-size: 2rem;
      position: relative;
      top: -10px;
      color: #ffffffaa;
    }

    .testimonial::after {
      content: "”";
      font-size: 2rem;
      position: relative;
      bottom: -10px;
      color: #ffffffaa;
    }

    footer {
      background-color: rgba(0, 0, 0, 0.85);
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .about-container h2 {
        font-size: 2.2rem;
      }

      .feature-card {
        width: 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <?php include('includes/navbar.php'); ?>
  <!-- About Section -->
  <section class="about-container">
    <h2>About JobPortal</h2>
    <p><strong>JobPortal</strong> is a modern solution for professionals, job seekers, and companies seeking excellence in recruitment. Whether you're looking to launch your career or expand your workforce, our platform is built to connect you efficiently and effectively.</p>
    <p>We offer a wide range of categories—from tech, marketing, healthcare, to finance—with real-time listings and personalized job alerts. Our goal is simple: <strong>make finding a job feel less like a hunt and more like a discovery.</strong></p>
    
    <!-- Features -->
    <div class="feature-section">
      <div class="feature-card">
        <img src="https://img.icons8.com/color/96/briefcase.png" alt="Smart Match">
        <h5>Smart Match</h5>
        <p>AI-powered matching engine that brings you the most relevant jobs.</p>
      </div>
      <div class="feature-card">
        <img src="https://img.icons8.com/color/96/speed.png" alt="Quick Apply">
        <h5>1-Click Apply</h5>
        <p>Save time with easy application options and quick uploads.</p>
      </div>
      <div class="feature-card">
        <img src="https://img.icons8.com/color/96/handshake.png" alt="Verified Employers">
        <h5>Verified Companies</h5>
        <p>We verify every employer to ensure legitimacy and trust.</p>
      </div>
      <div class="feature-card">
        <img src="https://img.icons8.com/color/96/goal.png" alt="Career Goals">
        <h5>Career Coaching</h5>
        <p>Access resume tips, mock interviews, and mentorship tools.</p>
      </div>
      <div class="feature-card">
        <img src="https://img.icons8.com/color/96/increase-profits.png" alt="Growth">
        <h5>Growth Insights</h5>
        <p>View company profiles, salaries, and growth forecasts before you apply.</p>
      </div>
      <div class="feature-card">
        <img src="https://img.icons8.com/color/96/online-support.png" alt="Support">
        <h5>24/7 Support</h5>
        <p>Get assistance anytime from our dedicated support team.</p>
      </div>
    </div>

    <!-- Testimonials -->
    <div class="testimonial-section">
      <?php
      // Optional: Replace with DB fetch if using a database table
      echo '
        <div class="testimonial">
          “JobPortal helped me land my first tech job within two weeks. The interface is intuitive and the employers are truly top-notch.”
          <br><br><strong>- Priya S., Frontend Developer</strong>
        </div>
        <div class="testimonial">
          “As a recruiter, I’ve hired five amazing candidates through JobPortal. It’s my go-to platform now.”
          <br><br><strong>- Ravi K., HR Manager</strong>
        </div>';
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 JobPortal. All Rights Reserved.</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
