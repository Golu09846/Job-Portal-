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
        position: relative;
        border: none;
        border-radius: 20px;
        backdrop-filter: blur(12px);
        background: linear-gradient(145deg, rgba(0, 255, 204, 0.15), rgba(0, 255, 153, 0.15));
        color: white;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        transition: all 0.4s ease;
        overflow: hidden;
        z-index: 1;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 140%;
        height: 140%;
        background: radial-gradient(circle, rgba(0,255,153,0.3), transparent 70%);
        transform: translate(-50%, -50%) scale(0.9);
        opacity: 0;
        z-index: -1;
        transition: all 0.4s ease-in-out;
        border-radius: 50%;
        filter: blur(20px);
    }

    .card:hover::before {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.2);
    }

    .card:hover {
        transform: translateY(-7px) scale(1.02);
        box-shadow: 0 12px 24px rgba(0, 255, 153, 0.4);
    }

    .card:hover .card-title {
        color: #9b59b6;
        text-shadow: 0 0 5px #00ffe7, 0 0 10px #00f7ff;
        transform: scale(1.05);
    }

    .card img {
        width: 80px;
        height: 80px;
        margin-top: 20px;
        transition: transform 0.3s ease;
    }

    .card:hover img {
        transform: scale(1.1);
    }

    .btn {
        border-radius: 30px;
        padding: 6px 20px;
        border: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 0 8px #9b59b6;
    }

    .btn-users        { background-color: #00bcd4; color: white; }
    .btn-jobs         { background-color: #1abc9c; color: white; }
    .btn-applications { background-color: #3498db; color: white; }
    .btn-admins       { background-color: #9b59b6; color: white; }
    .btn-settings     { background-color: #16a085; color: white; }
    .btn-reports      { background-color: #f39c12; color: white; }

    .card-title {
        font-weight: 600;
        margin-top: 15px;
        transition: all 0.3s ease;
    }

    .glow-text {
        color: white;
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
        <h3 class="glow-text mb-4 text-center" data-aos="zoom-in">Welcome to the Admin Dashboard</h3>

        <div class="row justify-content-center g-4">

            <!-- Manage Users -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card text-center p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="Users Icon">
                    <h5 class="card-title mt-3"><i class="fas fa-users me-2"></i>Manage Users</h5>
                    <p class="card-text">View and control all user accounts in the system.</p>
                    <a href="manage-users.php" class="btn btn-users">Go</a>
                </div>
            </div>

            <!-- Manage Jobs -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card text-center p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Jobs Icon">
                    <h5 class="card-title mt-3"><i class="fas fa-briefcase me-2"></i>Manage Jobs</h5>
                    <p class="card-text">Post, edit or remove job openings available for applicants.</p>
                    <a href="manage-jobs.php" class="btn btn-jobs">Go</a>
                </div>
            </div>

            <!-- Manage Applications -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card text-center p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/3595/3595455.png" alt="Applications Icon">
                    <h5 class="card-title mt-3"><i class="fas fa-file-alt me-2"></i>Manage Applications</h5>
                    <p class="card-text">Review and track all job applications submitted by users.</p>
                    <a href="manage-applications.php" class="btn btn-applications">Go</a>
                </div>
            </div>

            <!-- Manage Admins -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card text-center p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/1144/1144709.png" alt="Admins Icon">
                    <h5 class="card-title mt-3"><i class="fas fa-user-shield me-2"></i>Manage Admins</h5>
                    <p class="card-text">Add, edit, or remove admin accounts and roles.</p>
                    <a href="manage-admin.php" class="btn btn-admins">Go</a>
                </div>
            </div>
            <!-- Reports -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card text-center p-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828919.png" alt="Reports Icon">
                    <h5 class="card-title mt-3"><i class="fas fa-chart-line me-2"></i>Reports & Analytics</h5>
                    <p class="card-text">Generate insights and performance reports of the platform.</p>
                    <a href="reports.php" class="btn btn-reports">Go</a>
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
