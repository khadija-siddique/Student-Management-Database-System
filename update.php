<?php
include 'db.php';

$id         = intval($_POST['id']);
$fullname   = mysqli_real_escape_string($conn, $_POST['fullname']);
$email      = mysqli_real_escape_string($conn, $_POST['email']);
$phone      = mysqli_real_escape_string($conn, $_POST['phone']);
$rollno     = mysqli_real_escape_string($conn, $_POST['rollno']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$semester   = mysqli_real_escape_string($conn, $_POST['semester']);
$program    = mysqli_real_escape_string($conn, $_POST['program']);
$marks      = intval($_POST['marks']);

$sql = "UPDATE students SET
  fullname='$fullname',
  email='$email',
  phone='$phone',
  rollno='$rollno',
  department='$department',
  semester='$semester',
  program='$program',
  marks='$marks'
WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Student updated successfully! ✅'); window.location.href='view.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
