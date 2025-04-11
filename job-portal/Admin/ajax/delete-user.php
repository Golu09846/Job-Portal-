<?php
include('../includes/db.php');

if (isset($_POST['id'])) {
    $user_id = intval($_POST['id']);
    $query = "DELETE FROM users WHERE user_id = $user_id";

    if (mysqli_query($conn, $query)) {
        echo 'success';
    } else {
        echo 'error: ' . mysqli_error($conn);  // <--- ADD THIS
    }
} else {
    echo 'invalid';
}
