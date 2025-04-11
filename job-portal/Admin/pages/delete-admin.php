<?php
include('../includes/db.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $admin_id = (int) $_GET['id'];

    // Get admin data
    $check = mysqli_query($conn, "SELECT * FROM admins WHERE admin_id = $admin_id");
    $admin = mysqli_fetch_assoc($check);

    if ($admin) {
        // ✅ Block deletion if it's super_admin (case-insensitive)
        if (strtolower($admin['role']) !== 'super_admin') {
            // 🔥 Permanently delete the admin from the database
            $delete = mysqli_query($conn, "DELETE FROM admins WHERE admin_id = $admin_id");

            if ($delete) {
                header("Location: manage-admin.php?msg=Admin+deleted+successfully");
                exit;
            } else {
                header("Location: manage-admin.php?msg=Failed+to+delete+admin");
                exit;
            }
        } else {
            header("Location: manage-admin.php?msg=Super+admin+cannot+be+deleted");
            exit;
        }
    } else {
        header("Location: manage-admin.php?msg=Admin+not+found");
        exit;
    }
} else {
    header("Location: manage-admin.php?msg=Invalid+request");
    exit;
}
