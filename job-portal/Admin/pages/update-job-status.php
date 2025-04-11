<?php
include('../includes/db.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $newStatus = $_GET['status'];

    $update = "UPDATE jobs SET status='$newStatus' WHERE job_id='$id'";
    if (mysqli_query($conn, $update)) {
        header("Location: manage-jobs.php?msg=status_updated");
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}
?>
