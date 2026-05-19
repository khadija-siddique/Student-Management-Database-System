<?php
include 'db.php';

$id = intval($_GET['id']);

if (mysqli_query($conn, "DELETE FROM students WHERE id=$id")) {
    echo "<script>alert('Student deleted successfully!'); window.location.href='view.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
