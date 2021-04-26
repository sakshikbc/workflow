<?php

require_once('app/config.php');
if (isset($_POST['id'])) {
    $sql = "UPDATE workflow SET status='0' WHERE id=$_POST[id]";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";

    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}