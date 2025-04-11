<?php
// session_start();
$adminName = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
?>

<nav class="navbar navbar-expand-lg navbar-dark shadow-lg py-3" style="background: linear-gradient(to right, #0f2027, #203a43, #2c5364);">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand fw-bold neon-text d-flex align-items-center" href="../pages/dashboard.php">
            <i class="fas fa-user-shield me-2 fs-4"></i>
            <span>Admin Panel</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">

                <!-- Navigation Links -->
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active neon-text' : 'text-light'; ?>" href="../pages/dashboard.php">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-jobs.php' ? 'active neon-text' : 'text-light'; ?>" href="../pages/manage-jobs.php">
                        <i class="fas fa-briefcase me-1"></i> Manage Jobs
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-applications.php' ? 'active neon-text' : 'text-light'; ?>" href="../pages/manage-applications.php">
                        <i class="fas fa-file-alt me-1"></i> Manage Applications
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-users.php' ? 'active neon-text' : 'text-light'; ?>" href="../pages/manage-users.php">
                        <i class="fas fa-users me-1"></i> Manage Users
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'manage-admins.php' ? 'active neon-text' : 'text-light'; ?>" href="../pages/manage-admin.php">
                        <i class="fas fa-user-cog me-1"></i> Manage Admins
                    </a>
                </li>

                <!-- Divider -->
                <li class="nav-item mx-2">
                    <span class="text-light">|</span>
                </li>

                <!-- Admin Greeting -->
                <li class="nav-item me-2">
                    <span class="text-light">
                        <i class="fas fa-user-circle me-1"></i> Welcome, <strong><?php echo htmlspecialchars($adminName); ?></strong>
                    </span>
                </li>

                <!-- Settings -->
                <li class="nav-item me-2">
                    <a class="btn btn-neon-green btn-sm rounded-pill px-3" href="#">
                        <i class="fas fa-cogs me-1"></i> Settings
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="../logout.php" class="btn btn-neon-red btn-sm rounded-pill shadow-sm px-3">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Neon Button & Navbar Style -->
<style>
    .neon-text {
        color: #ccffcc !important;
        text-shadow: 0 0 5px #66ff99, 0 0 10px #00e676, 0 0 15px #00e676;
        transition: 0.3s ease;
    }

    .navbar-brand:hover {
        text-shadow: 0 0 12px #00e676;
        transform: scale(1.05);
    }

    .nav-link {
        transition: 0.3s ease-in-out;
    }

    .nav-link:hover {
        color: #00ffc8 !important;
        text-shadow: 0 0 6px #00e676;
    }

    .nav-link.active {
        font-weight: bold;
        border-bottom: 2px solid #00e676;
        text-shadow: 0 0 10px #00ffb3;
    }

    .btn-neon-green {
        background-color: transparent;
        border: 1px solid #00ff99;
        color: #00ff99;
        box-shadow: 0 0 5px #00ff99;
        transition: 0.4s ease-in-out;
    }

    .btn-neon-green:hover {
        background-color: #00ff99;
        color: #000;
        box-shadow: 0 0 15px #00ff99, 0 0 25px #00ff99;
        transform: scale(1.05);
    }

    .btn-neon-red {
        background-color: transparent;
        border: 1px solid #ff4d4d;
        color: #ff4d4d;
        box-shadow: 0 0 5px #ff4d4d;
        transition: 0.4s ease-in-out;
    }

    .btn-neon-red:hover {
        background-color: #ff4d4d;
        color: #000;
        box-shadow: 0 0 15px #ff4d4d, 0 0 25px #ff4d4d;
        transform: scale(1.05);
    }
</style>
