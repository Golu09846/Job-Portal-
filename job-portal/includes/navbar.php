<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
  <div class="container">
    <a class="navbar-brand gradient-text" href="index.php">JobPortal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item <?= $currentPage == 'index.php' ? 'active' : '' ?>">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item <?= $currentPage == 'job-details.php' ? 'active' : '' ?>">
          <a class="nav-link" href="job-details.php">Jobs</a>
        </li>
        <li class="nav-item <?= $currentPage == 'about.php' ? 'active' : '' ?>">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item <?= $currentPage == 'contact.php' ? 'active' : '' ?>">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li class="nav-item <?= $currentPage == 'applications.php' ? 'active' : '' ?>">
          <a class="nav-link" href="submitted-applications.php">Applications</a>
        </li>
        <li class="nav-item <?= $currentPage == 'login.php' ? 'active' : '' ?>">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item <?= $currentPage == 'register.php' ? 'active' : '' ?>">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  .custom-navbar {
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 10px 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    z-index: 1050;
  }

  .gradient-text {
    background: linear-gradient(45deg, #00f2fe, #4facfe);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
    font-size: 1.6rem;
    letter-spacing: 1px;
    transition: transform 0.3s ease;
  }

  .gradient-text:hover {
    transform: scale(1.05);
  }

  .navbar-nav .nav-link {
    color: #eaf7fa !important;
    padding: 8px 15px;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
    position: relative;
    z-index: 1;
  }

  .navbar-nav .nav-link::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 8px;
    background: linear-gradient(120deg, #00f2fe, #4facfe);
    z-index: -1;
    opacity: 0;
    transform: scaleX(0);
    transition: all 0.3s ease-in-out;
  }

  .navbar-nav .nav-link:hover::before,
  .navbar-nav .nav-item.active .nav-link::before {
    opacity: 0.2;
    transform: scaleX(1);
  }

  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-item.active .nav-link {
    color: #ffffff !important;
    background-color: rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 10px #00f2fe88;
  }

  .navbar-toggler {
    border: none;
  }

  .navbar-toggler:focus {
    outline: none;
    box-shadow: none;
  }
</style>
