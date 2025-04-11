<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Job Portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(270deg, #0f2027, #203a43, #2c5364);
      background-size: 600% 600%;
      animation: bgAnimate 30s ease infinite;
      font-family: 'Segoe UI', sans-serif;
      color: #eaf7fa;
      margin: 0;
      padding-top: 80px;
    }

    @keyframes bgAnimate {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    section, header, .card {
      background: linear-gradient(135deg, rgba(0, 255, 255, 0.33), rgba(0, 85, 128, 0.18), rgba(0, 255, 200, 0.15));
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      padding: 40px;
      margin: 30px auto;
      width: 90%;
      max-width: 1200px;
      color: #eaf7fa;
      transition: all 0.3s ease;
      animation: fadeIn 1s ease forwards;
      opacity: 0;
    }

    @keyframes fadeIn {
      to { opacity: 1; }
    }

    .card {
      position: relative;
      overflow: hidden;
    }

    .card::before {
      content: "";
      position: absolute;
      top: -2px; left: -2px; right: -2px; bottom: -2px;
      background: linear-gradient(120deg, #00ffff, #0056b3, #00c6ff, #00ffff);
      background-size: 600% 600%;
      z-index: -1;
      filter: blur(6px);
      animation: borderMove 6s ease infinite;
    }

    @keyframes borderMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .card:hover {
      transform: perspective(1000px) rotateY(3deg) scale(1.04);
      box-shadow: 0 0 25px #00ffff, 0 0 60px rgba(0,255,255,0.2);
    }

    .hero-content {
      background: rgba(0, 0, 0, 0.6);
      color: #ffffff;
      text-align: center;
      padding: 120px 20px 100px;
      border-radius: 20px;
    }

    .hero-content h1 {
      font-size: 3.5rem;
      font-weight: 800;
      text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
    }

    .btn-light, .btn-primary {
      border-radius: 30px;
      padding: 12px 25px;
      font-weight: 600;
      transition: all 0.3s ease-in-out;
      border: none;
      animation: pulseGlow 2s infinite;
    }

    .btn-light:hover, .btn-primary:hover {
      transform: scale(1.07);
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.7), 0 0 30px rgba(0, 255, 255, 0.3);
    }

    @keyframes pulseGlow {
      0% { box-shadow: 0 0 10px rgba(0,255,255,0.3); }
      50% { box-shadow: 0 0 20px rgba(0,255,255,0.7); }
      100% { box-shadow: 0 0 10px rgba(0,255,255,0.3); }
    }

    .text-section {
      background: linear-gradient(135deg, rgba(0, 150, 200, 0.3), rgba(0, 255, 150, 0.25));
      padding: 30px;
      border-radius: 20px;
      font-size: 1.1rem;
      line-height: 1.8;
    }

    .offer-icon, .job-icon, .testimonial-img {
      width: 60px;
      height: 60px;
      margin-bottom: 15px;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }

    .testimonial-img {
      border-radius: 50%;
      border: 3px solid #fff;
    }

    .section-heading {
      font-weight: 700;
      margin-bottom: 2rem;
      text-align: center;
      color: #ffffff;
      text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
    }

    footer {
      background-color: rgba(0, 0, 0, 0.9);
      color: #eaf7fa;
      padding: 20px 0;
    }

    #cta {
      background: linear-gradient(to right, #007bff, #00c6ff);
      border-radius: 20px;
      margin: 30px auto;
      max-width: 1000px;
      width: 90%;
      padding: 40px;
      color: #ffffff;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.7);
      border: 1px solid #ccc;
      color: #333;
    }

    .form-control:focus {
      box-shadow: 0 0 8px rgba(0,123,255,0.7);
      background-color: rgba(255, 255, 255, 0.9);
      color: #000;
    }

    #scrollTopBtn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      font-size: 24px;
      display: none;
      z-index: 1000;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.6);
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    #scrollTopBtn:hover {
      background-color: #0056b3;
      transform: scale(1.1);
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.9);
    }
  </style>
</head>
<body>

<?php include('includes/navbar.php'); ?>

<header data-aos="fade-up">
  <div class="hero-content">
    <h1>Welcome to JobPortal</h1>
    <p class="lead">Your dream job is just a click away</p>
    <a href="job-details.php" class="btn btn-light btn-lg mt-3">Explore Jobs</a>
  </div>
</header>

<section class="text-section text-center" data-aos="fade-up">
  <h3 class="section-heading">About Us</h3>
  <p><strong>JobPortal</strong> is your gateway to <strong>top jobs</strong> and <strong>trusted employers</strong>.</p>
  <p>We simplify your job search by connecting you with the right opportunities.</p>
  <a href="about.php" class="btn btn-primary mt-3">Learn More</a>
</section>

<section class="text-center text-section" data-aos="fade-up">
  <h3 class="section-heading">What We Offer</h3>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card p-4">
        <img src="images/match-icon.png" class="offer-icon" alt="Match">
        <h5>Smart Job Matching</h5>
        <p>Get jobs tailored to your profile and preferences.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <img src="images/easy-apply-icon.png" class="offer-icon" alt="Easy Apply">
        <h5>Easy Application</h5>
        <p>Apply in one click. No complex forms.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <img src="images/trusted-icon.png" class="offer-icon" alt="Trusted">
        <h5>Trusted Companies</h5>
        <p>Connect with verified, top-tier employers.</p>
      </div>
    </div>
  </div>
</section>

<section class="text-section" data-aos="fade-up">
  <h3 class="section-heading">Featured Jobs</h3>
  <div class="row text-center">
    <?php
    include('includes/db.php');
    $sql = "SELECT job_id, title, location, company_name FROM jobs WHERE status = 'active' ORDER BY created_at DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="col-md-4">
          <div class="card p-4">
            <img src="images/dev-icon.png" class="job-icon" alt="Job Icon">
            <h5>' . htmlspecialchars($row["title"]) . '</h5>
            <p>' . htmlspecialchars($row["company_name"]) . ' · ' . htmlspecialchars($row["location"]) . '</p>
            <a href="job-details.php?id=' . $row["job_id"] . '" class="btn btn-primary">View Job</a>
          </div>
        </div>';
      }
    } else {
      echo "<p class='text-white'>No featured jobs available right now.</p>";
    }
    mysqli_close($conn);
    ?>
  </div>
</section>

<section class="text-section text-center" data-aos="fade-up">
  <h3 class="section-heading">What Our Users Say</h3>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card p-4">
        <img src="images/jane.jpg" class="testimonial-img mb-3" alt="User 1">
        <h5>Jane Doe</h5>
        <p>"JobPortal helped me land my dream job within a week. Super intuitive and easy to use!"</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <img src="images/john.jpg" class="testimonial-img mb-3" alt="User 2">
        <h5>Mark Smith</h5>
        <p>"The smart job matching is fantastic. It saved me so much time and effort."</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <img src="images/sarah.jpg" class="testimonial-img mb-3" alt="User 3">
        <h5>Sarah Lee</h5>
        <p>"I posted a job and found the perfect candidate in just a few days. Highly recommend!"</p>
      </div>
    </div>
  </div>
</section>

<section id="cta" class="text-white text-center" data-aos="zoom-in">
  <h2>Start Your Job Search Today</h2>
  <p>Sign up now and take the first step!</p>
  <a href="register.php" class="btn btn-light">Sign Up Now</a>
</section>

<footer class="text-center">
  &copy; 2025 JobPortal · <a href="#" class="text-white">Facebook</a> · <a href="#" class="text-white">Twitter</a>
</footer>

<button onclick="topFunction()" id="scrollTopBtn" title="Go to top">↑</button>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
  let mybutton = document.getElementById("scrollTopBtn");
  window.onscroll = function () {
    mybutton.style.display = (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) ? "block" : "none";
  };
  function topFunction() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

</body>
</html>
