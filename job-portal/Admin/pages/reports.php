<?php include('../includes/session.php'); ?>
<?php include('../includes/head.php'); ?>
<style><?php include('../includes/style.php'); ?></style>

<style>
    body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }

    .bg-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: -1;
    }

    .card {
        border-radius: 20px;
        background: linear-gradient(145deg, rgba(255,255,255,0.05), rgba(0,255,204,0.07));
        backdrop-filter: blur(12px);
        color: white;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 50%; left: 50%;
        width: 150%; height: 150%;
        background: radial-gradient(circle, rgba(0,255,153,0.25), transparent 70%);
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
        transition: 0.5s ease-in-out;
        border-radius: 50%;
        filter: blur(25px);
        z-index: -1;
    }

    .card:hover::before {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.1);
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 12px 24px rgba(0, 255, 204, 0.4);
    }

    .card-title {
        font-weight: bold;
        color: #00e6d0;
        text-shadow: 0 0 6px rgba(0,255,255,0.4);
        margin-bottom: 15px;
    }

    .card-text {
        color: #ddd;
    }

    .btn-reports {
        background-color: #f39c12;
        border-radius: 30px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-reports:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px #f39c12;
        color: #fff;
    }

    .glow-text {
        color: #fff;
        text-shadow: 0 0 5px #00ffe7, 0 0 10px #00e6d0, 0 0 20px #00bcd4;
    }

    footer p {
        color: #eee;
        text-shadow: 0 0 4px rgba(0,255,255,0.4);
    }

    .btn-light {
        transition: all 0.3s ease;
    }

    .btn-light:hover {
        transform: scale(1.1);
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
    }
</style>

<body>
    <div class="bg-overlay"></div>
    <?php include('../includes/navbar.php'); ?>

    <div class="container mt-5">
        <h3 class="glow-text mb-5 text-center" data-aos="fade-down">📊 Reports & Analytics</h3>

        <div class="row g-4 justify-content-center">

            <!-- User Stats -->
            <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card text-center p-4">
                    <h5 class="card-title"><i class="fas fa-users me-2"></i>User Statistics</h5>
                    <p class="card-text">Visualize active users, registrations, and user growth.</p>
                    <a href="#" class="btn btn-reports">View</a>
                </div>
            </div>

            <!-- Job Reports -->
            <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card text-center p-4">
                    <h5 class="card-title"><i class="fas fa-briefcase me-2"></i>Job Reports</h5>
                    <p class="card-text">Monitor job posts, active jobs, and hiring trends.</p>
                    <a href="#" class="btn btn-reports">Check</a>
                </div>
            </div>

            <!-- Application Insights -->
            <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card text-center p-4">
                    <h5 class="card-title"><i class="fas fa-file-alt me-2"></i>Application Insights</h5>
                    <p class="card-text">Track application submissions and approval rates.</p>
                    <a href="#" class="btn btn-reports">Analyze</a>
                </div>
            </div>

            <!-- Custom Reports -->
            <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card text-center p-4">
                    <h5 class="card-title"><i class="fas fa-chart-bar me-2"></i>Custom Reports</h5>
                    <p class="card-text">Generate custom data reports based on filters.</p>
                    <a href="#" class="btn btn-reports">Generate</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to top button -->
    <button onclick="scrollToTop()" class="btn btn-light shadow rounded-circle position-fixed" 
            style="bottom: 20px; right: 20px;" title="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Footer -->
    <footer class="text-center text-light mt-5 mb-3 small">
        <p>&copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.</p>
    </footer>

    <?php include('../includes/footer-scripts.php'); ?>

    <script>
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>
</html>
