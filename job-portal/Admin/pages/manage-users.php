<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../includes/session.php');
include('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <?php include('../includes/head.php'); ?>
    <style><?php include('../includes/style.php'); ?></style>
    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .glass-card, .mini-box {
            background: linear-gradient(145deg, rgba(255,255,255,0.08), rgba(255,255,255,0.04));
            backdrop-filter: blur(14px);
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(155, 89, 182, 0.2);
            color: #fff;
            position: relative;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .glass-card::before, .mini-box::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 130%;
            height: 130%;
            background: radial-gradient(circle, rgba(155,89,182,0.3), transparent 70%);
            transform: translate(-50%, -50%) scale(0.9);
            opacity: 0;
            z-index: -1;
            border-radius: 50%;
            transition: all 0.4s ease-in-out;
            filter: blur(18px);
        }

        .glass-card:hover::before, .mini-box:hover::before {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.2);
        }

        .glass-card:hover, .mini-box:hover {
            box-shadow: 0 12px 28px rgba(155,89,182,0.5);
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

        .table {
            background: rgba(255,255,255,0.07);
            border-radius: 12px;
            overflow: hidden;
            color: white;
        }

        .table thead {
            background: rgba(255,255,255,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .table th, .table td {
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

        .badge-success {
            background-color: #2ecc71;
        }

        .badge-danger {
            background-color: #e74c3c;
        }

        .btn-sm i {
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>
    <?php include('../includes/navbar.php'); ?>

    <div class="container mt-5">
        <h3 class="glow-title text-center" data-aos="zoom-in"><i class="fas fa-users me-2"></i>Manage Users</h3>

        <!-- Stats Boxes -->
        <div class="row text-center g-4 mb-4">
            <?php
            $total = $active = $inactive = 0;
            $res1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
            if ($res1) $total = mysqli_fetch_assoc($res1)['total'];

            $res2 = mysqli_query($conn, "SELECT COUNT(*) AS active FROM users WHERE status = 'active'");
            if ($res2) $active = mysqli_fetch_assoc($res2)['active'];

            $res3 = mysqli_query($conn, "SELECT COUNT(*) AS inactive FROM users WHERE status = 'inactive'");
            if ($res3) $inactive = mysqli_fetch_assoc($res3)['inactive'];
            ?>
            <div class="col-md-4" data-aos="zoom-in-up">
                <div class="mini-box">
                    <i class="fas fa-users"></i>
                    <h5>Total Users</h5>
                    <p><?= $total ?></p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="100">
                <div class="mini-box">
                    <i class="fas fa-user-check"></i>
                    <h5>Active</h5>
                    <p><?= $active ?></p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="200">
                <div class="mini-box">
                    <i class="fas fa-user-times"></i>
                    <h5>Inactive</h5>
                    <p><?= $inactive ?></p>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="glass-card mt-3 p-4" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><i class="fas fa-list me-2"></i>User List</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $result = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id DESC");
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $statusBadge = ($row['status'] == 'active') 
                                    ? '<span class="badge badge-success">Active</span>' 
                                    : '<span class="badge badge-danger">Inactive</span>';

                                echo '<tr data-id="' . $row['user_id'] . '">';
                                echo '<td>' . $i++ . '</td>';
                                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                echo '<td>' . $statusBadge . '</td>';
                                echo '<td>
                                        <button class="btn btn-sm btn-danger delete-user">
                                            <i class="fas fa-user-slash"></i> Remove
                                        </button>
                                      </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No users found.</td></tr>';
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

    <!-- AJAX Delete Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr');
                    const userId = row.getAttribute('data-id');

                    if (confirm('Are you sure you want to remove this user?')) {
                        fetch('../ajax/delete-user.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + encodeURIComponent(userId)
                        })
                        .then(res => res.text())
                        .then(response => {
                            if (response.trim() === 'success') {
                                row.remove();
                            } else {
                                alert('Failed to delete user.');
                                console.log(response);
                            }
                        })
                        .catch(err => {
                            console.error('AJAX Error:', err);
                            alert('An error occurred.');
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
