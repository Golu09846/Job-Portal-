<?php include('../includes/session.php'); ?>
<?php include('../includes/head.php'); ?>
<style><?php include('../includes/style.php'); ?></style>

<style>
   body {
    background: linear-gradient(to right, #0c0c0c, #1a1a1a, #2b2b2b);
    font-family: 'Segoe UI', sans-serif;
    overflow-x: hidden;
}

.form-container {
    max-width: 750px;
    margin: 60px auto;
    background: rgba(20, 20, 20, 0.6);
    backdrop-filter: blur(20px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(138, 43, 226, 0.4);
    color: #f5f5f5;
    transition: transform 0.3s ease;
}

.form-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 36px rgba(186, 85, 211, 0.5);
}

.form-container h2 {
    text-align: center;
    margin-bottom: 35px;
    color: #d9b3ff;
    text-shadow: 0 0 6px #c77dff, 0 0 14px #b666ff;
}

.form-label {
    font-weight: 600;
    color: #f1eaff;
    margin-bottom: 8px;
}

.form-control {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid #333;
    color: #eee;
    padding: 10px 15px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.form-control::placeholder {
    color: #aaa;
}

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid #d28aff;
    box-shadow: 0 0 10px #a855f7;
}

.form-control:hover {
    background-color: rgba(255, 255, 255, 0.08);
    border: 1px solid #985eff;
}

textarea.form-control {
    resize: none;
}

.btn-submit {
    background-color: #7e22ce;
    color: white;
    font-weight: bold;
    border-radius: 12px;
    padding: 12px;
    transition: 0.3s ease;
    border: none;
}

.btn-submit:hover {
    background-color: #6b21a8;
    transform: scale(1.04);
    box-shadow: 0 0 12px #c084fc;
}

.alert {
    margin-top: 20px;
    border-radius: 12px;
    font-weight: 500;
    text-align: center;
}

.alert-success {
    background-color: #1f3c2e;
    color: #a9f5d0;
}

.alert-danger {
    background-color: #4b1f22;
    color: #ffb3ba;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.06);
}

::-webkit-scrollbar-thumb {
    background-color: #8e44ad;
    border-radius: 10px;
}

</style>

<body>
<?php include('../includes/navbar.php'); ?>

<div class="container">
    <div class="form-container" data-aos="zoom-in">
        <h2><i class="fas fa-briefcase"></i> Add New Job</h2>

        <?php
        include('../includes/db.php');

        $successMsg = $errorMsg = '';

        if (isset($_POST['submit'])) {
            $title        = mysqli_real_escape_string($conn, $_POST['title']);
            $location     = mysqli_real_escape_string($conn, $_POST['location']);
            $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
            $salary_range = mysqli_real_escape_string($conn, $_POST['salary_range']);
            $description  = mysqli_real_escape_string($conn, $_POST['description']);
            $created_by   = $_SESSION['username'];
            $status       = 'Active';
            $created_at   = date('Y-m-d H:i:s');

            $query = "INSERT INTO jobs (title, location, company_name, salary_range, description, created_by, status, created_at) 
                      VALUES ('$title', '$location', '$company_name', '$salary_range', '$description', '$created_by', '$status', '$created_at')";

            if (mysqli_query($conn, $query)) {
                $successMsg = "🎉 Job added successfully!";
            } else {
                $errorMsg = "❌ Error: " . mysqli_error($conn);
            }
        }

        if (!empty($successMsg)) {
            echo "<div class='alert alert-success'>$successMsg</div>";
        }

        if (!empty($errorMsg)) {
            echo "<div class='alert alert-danger'>$errorMsg</div>";
        }
        ?>

        <form method="POST" action="">
            <div class="mb-3" data-aos="fade-right">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter job title" required>
            </div>
            <div class="mb-3" data-aos="fade-right" data-aos-delay="100">
                <label class="form-label">Department / Location</label>
                <input type="text" name="location" class="form-control" placeholder="E.g., IT Department, Karachi" required>
            </div>
            <div class="mb-3" data-aos="fade-right" data-aos-delay="200">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" placeholder="E.g., ABC Tech Ltd" required>
            </div>
            <div class="mb-3" data-aos="fade-right" data-aos-delay="300">
                <label class="form-label">Salary Range</label>
                <input type="text" name="salary_range" class="form-control" placeholder="E.g., 40,000 - 60,000 PKR" required>
            </div>
            <div class="mb-3" data-aos="fade-right" data-aos-delay="400">
                <label class="form-label">Job Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Job details here..." required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-submit w-100" data-aos="zoom-in" data-aos-delay="500">+ Add Job</button>
        </form>
    </div>
</div>

<?php include('../includes/footer-scripts.php'); ?>
</body>
</html>
