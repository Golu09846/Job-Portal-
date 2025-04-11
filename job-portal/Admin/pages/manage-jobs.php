<?php include('../includes/session.php'); ?>
<?php include('../includes/head.php'); ?>
<style><?php include('../includes/style.php'); ?></style>

<style>
        body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        background-attachment: fixed;
        font-family: 'Segoe UI', sans-serif;
    }
    .bg-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: -1;
        filter: blur(14px);
    }
    .glow-title {
        color: #eacdfc;
        text-shadow: 0 0 6px #da9fff, 0 0 14px #c17aff;
        font-weight: bold;
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 40px;
    }
    .glass-card, .summary-card {
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
    .glass-card::before, .summary-card::before {
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
    .glass-card:hover::before, .summary-card:hover::before {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.2);
    }
    .glass-card:hover, .summary-card:hover {
        box-shadow: 0 12px 28px rgba(155, 89, 182, 0.5);
    }
    .summary-boxes {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 40px;
        justify-content: space-between;
    }
    .summary-card {
        flex: 1 1 200px;
        padding: 25px;
        text-align: center;
        cursor: pointer;
    }
    .summary-card h3 {
        font-size: 2rem;
        margin-bottom: 10px;
        color: #fff;
    }
    .summary-card p {
        margin: 0;
        font-size: 1rem;
        color: #cfc1e8;
    }
    .add-job-btn {
        background-color: #9b59b6;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        transition: 0.3s ease;
        padding: 8px 18px;
        border: none;
    }
    .add-job-btn:hover {
        background-color: #8e44ad;
        transform: scale(1.05);
        box-shadow: 0 0 10px #da9fff;
    }
    .table {
        background: rgba(255, 255, 255, 0.07);
        border-radius: 12px;
        overflow: hidden;
        color: white;
    }
    .table thead {
        background: rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255,255,255,0.15);
    }
    .table th, .table td {
        background: transparent;
        color: white;
        vertical-align: middle;
        padding: 14px 10px;
    }
    .job-table tbody tr {
        transition: 0.3s ease;
    }
    .job-table tbody tr:hover {
        background-color: rgba(155, 89, 182, 0.1);
        transform: scale(1.005);
        cursor: pointer;
    }
    .badge {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 12px;
    }
    .btn-sm i {
        margin-right: 4px;
        pointer-events: none;
    }
    .btn-sm:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(155, 89, 182, 0.3);
    }
    @media (max-width: 576px) {
        .glow-title {
            font-size: 1.8rem;
        }
        .summary-boxes {
            flex-direction: column;
        }
    }
</style>

<body>
<div class="bg-overlay"></div>
<?php include('../includes/navbar.php'); ?>

<div class="container mt-5">
    <h2 class="glow-title" data-aos="fade-down">Manage Jobs</h2>

    <?php
    include('../includes/db.php');

    function safeFetchCount($conn, $sql) {
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "<div style='color:red;'>Query Error: " . mysqli_error($conn) . "</div>";
            return 0;
        }
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    $totalJobs   = safeFetchCount($conn, "SELECT COUNT(*) AS total FROM jobs");
    $activeJobs  = safeFetchCount($conn, "SELECT COUNT(*) AS total FROM jobs WHERE status='Active'");
    $closedJobs  = safeFetchCount($conn, "SELECT COUNT(*) AS total FROM jobs WHERE status='Closed'");
    ?>

    <div class="summary-boxes" data-aos="zoom-in">
        <div class="summary-card"><h3><?= $totalJobs; ?></h3><p>Total Jobs</p></div>
        <div class="summary-card"><h3><?= $activeJobs; ?></h3><p>Active Jobs</p></div>
        <div class="summary-card"><h3><?= $closedJobs; ?></h3><p>Closed Jobs</p></div>
    </div>

    <div class="glass-card mt-3" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4><i class="fas fa-briefcase me-2"></i>Job Listings</h4>
            <a href="add-job.php" class="add-job-btn"><i class="fas fa-plus-circle me-1"></i>Add Job</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center job-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Posted On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $query = mysqli_query($conn, "SELECT * FROM jobs WHERE status IN ('Active', 'Closed') ORDER BY created_at DESC");
                while ($row = mysqli_fetch_assoc($query)) {
                    $jobId = $row['job_id'];
                    $title = htmlspecialchars($row['title']);
                    $location = htmlspecialchars($row['location']);
                    $status = $row['status'];
                    $badgeColor = $status == 'Active' ? 'success' : 'danger';
                    $createdAt = date('Y-m-d', strtotime($row['created_at']));

                    echo "<tr>
                        <td>{$i}</td>
                        <td>{$title}</td>
                        <td>{$location}</td>
                        <td><span class='badge bg-{$badgeColor}'>{$status}</span></td>
                        <td>{$createdAt}</td>
                        <td>";

                    if ($status == 'Active') {
                        echo "<a href='update-job-status.php?id={$jobId}&status=Closed' class='btn btn-sm btn-danger'>
                            <i class='fas fa-times-circle'></i> Close</a>";
                    } elseif ($status == 'Closed') {
                        echo "<a href='update-job-status.php?id={$jobId}&status=Active' class='btn btn-sm btn-success'>
                            <i class='fas fa-check-circle'></i> Activate</a>";
                    }

                    echo "</td></tr>";
                    $i++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('../includes/footer-scripts.php'); ?>
</body>
</html>
