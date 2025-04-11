<?php include('../includes/head.php'); ?>
<?php include('../includes/db.php'); ?>

<style>
    body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        font-family: 'Segoe UI', sans-serif;
        color: white;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        max-width: 600px;
        margin: auto;
        margin-top: 60px;
        box-shadow: 0 0 12px rgba(255, 255, 255, 0.1);
    }

    .form-card h3 {
        color: #eacdfc;
        text-shadow: 0 0 5px #c17aff;
        margin-bottom: 25px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: none;
        border-radius: 8px;
    }

    .form-control:focus {
        box-shadow: 0 0 5px #9b59b6;
    }

    .btn-submit {
        background-color: #9b59b6;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-submit:hover {
        background-color: #8e44ad;
    }

    .alert {
        margin-top: 15px;
        text-align: center;
    }
</style>

<body>
<?php include('../includes/navbar.php'); ?>

<div class="form-card" data-aos="fade-up">
    <h3 class="text-center"><i class="fas fa-user-plus me-2"></i>Add New Admin</h3>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $password = "default123"; // You should hash passwords in production

        $insertQuery = "INSERT INTO admins (name, email, role, status, password) 
                        VALUES ('$name', '$email', '$role', '$status', '$password')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<div class='alert alert-success' id='success-msg'>Admin added successfully!</div>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'manage-admin.php?msg=Admin+added+successfully';
                }, 2000);
            </script>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
    ?>

    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Role</label>
            <input type="text" name="role" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-submit w-100"><i class="fas fa-save me-1"></i>Save Admin</button>
    </form>
</div>

<?php include('../includes/footer-scripts.php'); ?>
</body>
</html>
