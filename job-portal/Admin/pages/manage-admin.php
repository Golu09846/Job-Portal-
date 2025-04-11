<?php include('../includes/head.php'); ?>
<style><?php include('../includes/style.php'); ?></style>
<?php include('../includes/db.php'); ?>

<style>
        body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        font-family: 'Segoe UI', sans-serif;
    }

    .bg-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: -1;
    }

    .glass-card,
    .mini-box {
        background: linear-gradient(145deg, rgba(155, 89, 182, 0.15), rgba(142, 68, 173, 0.15));
        backdrop-filter: blur(16px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(155, 89, 182, 0.3);
        color: #fff;
        transition: 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .glass-card::before,
    .mini-box::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 130%;
        height: 130%;
        background: radial-gradient(circle, rgba(155, 89, 182, 0.3), transparent 70%);
        transform: translate(-50%, -50%) scale(0.9);
        opacity: 0;
        z-index: -1;
        border-radius: 50%;
        transition: all 0.4s ease-in-out;
        filter: blur(18px);
    }

    .glass-card:hover::before,
    .mini-box:hover::before {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.2);
    }

    .glass-card:hover,
    .mini-box:hover {
        box-shadow: 0 12px 28px rgba(155, 89, 182, 0.5);
    }

    .mini-box {
        padding: 25px;
        text-align: center;
    }

    .mini-box h5 {
        font-size: 1rem;
        color: #cfc1e8;
        margin-bottom: 6px;
    }

    .mini-box p {
        font-size: 2rem;
        font-weight: bold;
        margin: 0;
        color: #fff;
    }

    .mini-box i {
        font-size: 1.6rem;
        margin-bottom: 8px;
        display: block;
        color: #e1bfff;
    }

    .glow-title {
        color: #eacdfc;
        text-shadow: 0 0 6px #da9fff, 0 0 14px #c17aff;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .btn-add {
        background-color: #9b59b6;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 500;
        transition: 0.3s ease;
    }

    .btn-add:hover {
        background-color: #8e44ad;
        transform: scale(1.05);
    }

    .table {
        background: rgba(255, 255, 255, 0.07);
        border-radius: 12px;
        overflow: hidden;
        color: white;
    }

    .table thead {
        background: rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .table th,
    .table td {
        background: transparent;
        color: white;
        vertical-align: middle;
        padding: 14px 10px;
    }

    .badge {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 12px;
    }

    .btn-sm i {
        pointer-events: none;
    }

    .alert {
        margin-top: 20px;
        transition: opacity 0.5s ease;
    }

</style>

<body>
    <div class="bg-overlay"></div>
    <?php include('../includes/navbar.php'); ?>

    <div class="container mt-5">
        <h3 class="glow-title text-center" data-aos="zoom-in">
            <i class="fas fa-user-shield me-2"></i>Manage Admins
        </h3>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-info text-center auto-dismiss" id="alert-box">
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById('alert-box');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(() => {
                            alert.remove();
                            // Remove ?msg=... from URL without reload
                            window.history.replaceState({}, document.title, "manage-admin.php");
                        }, 600);
                    }
                }, 2000);
            </script>
        <?php endif; ?>

        <?php
        function safe_query($conn, $query) {
            $result = mysqli_query($conn, $query);
            return $result ? mysqli_fetch_assoc($result)['total'] : 0;
        }

        $totalAdmins = safe_query($conn, "SELECT COUNT(*) AS total FROM admins");
        $activeAdmins = safe_query($conn, "SELECT COUNT(*) AS total FROM admins WHERE LOWER(status) = 'active'");
        $inactiveAdmins = safe_query($conn, "SELECT COUNT(*) AS total FROM admins WHERE LOWER(status) = 'inactive'");
        ?>

        <!-- Stat Boxes -->
        <div class="row text-center g-4 mb-4">
            <div class="col-md-4" data-aos="zoom-in-up">
                <div class="mini-box">
                    <i class="fas fa-users-cog"></i>
                    <h5>Total Admins</h5>
                    <p><?= $totalAdmins ?></p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="100">
                <div class="mini-box">
                    <i class="fas fa-user-check"></i>
                    <h5>Active</h5>
                    <p><?= $activeAdmins ?></p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="200">
                <div class="mini-box">
                    <i class="fas fa-user-times"></i>
                    <h5>Inactive</h5>
                    <p><?= $inactiveAdmins ?></p>
                </div>
            </div>
        </div>

        <!-- Admin Table -->
        <div class="glass-card mt-3" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><i class="fas fa-list me-2"></i>Admin List</h4>
                <a href="add-admin.php" class="btn btn-add">
                    <i class="fas fa-plus-circle me-1"></i>Add Admin
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admin Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM admins ORDER BY admin_id DESC";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $adminID   = $row['admin_id'];
                                $adminName = htmlspecialchars($row['name']);
                                $email     = htmlspecialchars($row['email']);
                                $role      = strtolower($row['role']);
                                $status    = strtolower($row['status']);
                                $statusBadge = $status === 'active' ? 'bg-success' : 'bg-secondary';

                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>$adminName</td>";
                                echo "<td>$email</td>";
                                echo "<td>" . ucfirst($role) . "</td>";
                                echo "<td><span class='badge $statusBadge'>" . ucfirst($status) . "</span></td>";
                                echo "<td>";

                                // ✅ Hide delete button for super_admin
                                if ($role !== 'super_admin') {
                                    echo "<a href='delete-admin.php?id={$adminID}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this admin?');\"><i class='fas fa-trash-alt'></i></a>";
                                }

                                echo "</td>";
                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No admins found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center text-light mt-5 mb-3 small">
        <p>&copy; <?= date('Y') ?> Admin Dashboard. All rights reserved.</p>
    </footer>

    <?php include('../includes/footer-scripts.php'); ?>
</body>
</html>
