<?php
include('includes/session.php');
include('includes/db.php');

if (!$conn) {
    die("Database connection failed.");
}

include('includes/head.php');
?>

<link rel="stylesheet" href="includes/style.php">

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

    .glass-card {
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

    .glass-card::before {
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

    .glass-card:hover::before {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.2);
    }

    .glass-card:hover {
        box-shadow: 0 12px 28px rgba(155, 89, 182, 0.5);
    }

    .glow-title {
        color: #eacdfc;
        text-shadow: 0 0 6px #da9fff, 0 0 14px #c17aff;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 25px;
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

    .badge.bg-success {
        background-color: #28a745;
    }

    .main-content {
        margin-top: 100px; /* Added space below navbar */
    }
</style>

<body>
    <div class="bg-overlay"></div>

    <?php include('includes/navbar.php'); ?>

    <div class="container main-content">
        <h3 class="glow-title text-center" data-aos="zoom-in">
            <i class="fas fa-paper-plane me-2"></i>Submitted Applications
        </h3>

        <div class="glass-card mt-4" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-3 px-3 pt-3">
                <h4><i class="fas fa-list me-2"></i>Approved Application Records</h4>
            </div>

            <div class="table-responsive px-3 pb-4">
                <table class="table table-bordered text-center mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Applicant Name</th>
                            <th>Email</th>
                            <th>Course Status</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT full_name, email, application_status, applied_at FROM applications ORDER BY applied_at DESC";
                        $result = mysqli_query($conn, $query);
                        $count = 1;

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$count}</td>
                                    <td>{$row['full_name']}</td>
                                    <td>{$row['email']}</td>
                                    <td><span class='badge bg-success'>{$row['application_status']}</span></td>
                                    <td>" . date("Y-m-d", strtotime($row['applied_at'])) . "</td>
                                </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No approved applications found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <?php include('includes/footer-scripts.php'); ?>
</body>
