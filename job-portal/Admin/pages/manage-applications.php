<?php
include('../includes/session.php');
include('../includes/db.php');
include('../includes/head.php');
?>

<link rel="stylesheet" href="../includes/style.php">

<?php
// Handle Approve/Reject Actions
if (isset($_GET['action'], $_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        mysqli_query($conn, "UPDATE applications SET application_status = 'Approved' WHERE id = $id");
    } elseif ($action === 'reject') {
        mysqli_query($conn, "UPDATE applications SET application_status = 'Not Approved' WHERE id = $id");
    }
    header("Location: manage-applications.php");
    exit();
}
?>

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

    .badge.bg-secondary {
        background-color: #6c757d;
    }

    .badge.bg-success {
        background-color: #28a745;
    }

    .badge.bg-danger {
        background-color: #dc3545;
    }

    .btn-sm i {
        pointer-events: none;
    }
</style>

<body>
    <div class="bg-overlay"></div>
    <?php include('../includes/navbar.php'); ?>

    <div class="container mt-5">
        <h3 class="glow-title text-center" data-aos="zoom-in"><i class="fas fa-file-alt me-2"></i>Manage Applications
        </h3>

        <?php
        // Application stats
        $total = $approved = $pending = $notApproved = 0;

        $res1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM applications");
        $res2 = mysqli_query($conn, "SELECT COUNT(*) AS approved FROM applications WHERE application_status = 'Approved'");
        $res3 = mysqli_query($conn, "SELECT COUNT(*) AS notApproved FROM applications WHERE application_status = 'Not Approved'");

        if ($res1)
            $total = mysqli_fetch_assoc($res1)['total'];
        if ($res2)
            $approved = mysqli_fetch_assoc($res2)['approved'];
        if ($res3)
            $notApproved = mysqli_fetch_assoc($res3)['notApproved'];

        $pending = $total - $approved - $notApproved;
        ?>

        <div class="row text-center g-4 mb-4">
            <div class="col-md-4" data-aos="zoom-in-up">
                <div class="mini-box">
                    <i class="fas fa-file-alt"></i>
                    <h5>Total Applications</h5>
                    <p><?php echo $total; ?></p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="100">
                <div class="mini-box">
                    <i class="fas fa-check-circle"></i>
                    <h5>Approved</h5>
                    <p><?php echo $approved; ?></p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="200">
                <div class="mini-box">
                    <i class="fas fa-times-circle"></i>
                    <h5>Pending</h5>
                    <p><?php echo $pending; ?></p>
                </div>
            </div>
        </div>

        <div class="glass-card mt-3" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-3 px-3 pt-3">
                <h4><i class="fas fa-list me-2"></i>Application List</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Applicant Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM applications ORDER BY applied_at DESC";
                        $result = mysqli_query($conn, $query);
                        $count = 1;

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $status = $row['application_status'] ?? 'Pending';
                                $badgeClass = 'bg-secondary';

                                if ($status === 'Approved') {
                                    $badgeClass = 'bg-success';
                                } elseif ($status === 'Not Approved') {
                                    $badgeClass = 'bg-danger';
                                }

                                // Handle resume link
                                $resumeLink = !empty($row['resume_file']) ? "<a href='../../resumes/{$row['resume_file']}' target='_blank' class='btn btn-info btn-sm'>View</a>" : "N/A";

                                echo "<tr>
                            <td>{$count}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['job_title']}</td>
                            <td>{$resumeLink}</td>
                            <td><span class='badge {$badgeClass}'>{$status}</span></td>
                            <td>" . date("Y-m-d", strtotime($row['applied_at'])) . "</td>
                            <td class='d-flex justify-content-center flex-wrap gap-1'>
                                <a href='?action=approve&id={$row['id']}' class='btn btn-sm btn-success' title='Approve'>
                                    <i class='fas fa-thumbs-up'></i> Approve
                                </a>
                                <a href='?action=reject&id={$row['id']}' class='btn btn-sm btn-danger' title='Reject'>
                                    <i class='fas fa-thumbs-down'></i> Reject
                                </a>
                            </td>
                        </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='8'>No applications found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center text-light mt-5 mb-3 small">
        <p>&copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.</p>
    </footer>

    <?php include('../includes/footer-scripts.php'); ?>
</body>

</html>