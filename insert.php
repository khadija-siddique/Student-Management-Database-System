<?php
include 'db.php';

$fullname        = mysqli_real_escape_string($conn, $_POST['fullname']);
$email           = mysqli_real_escape_string($conn, $_POST['email']);
$phone           = mysqli_real_escape_string($conn, $_POST['phone']);
$cnic            = mysqli_real_escape_string($conn, $_POST['cnic']);
$age             = intval($_POST['age']);
$gender          = mysqli_real_escape_string($conn, $_POST['gender']);
$rollno          = mysqli_real_escape_string($conn, $_POST['rollno']);
$department      = mysqli_real_escape_string($conn, $_POST['department']);
$semester        = mysqli_real_escape_string($conn, $_POST['semester']);
$program         = mysqli_real_escape_string($conn, $_POST['program']);
$marks           = intval($_POST['marks']);
$sports          = isset($_POST['sports']) ? "Yes" : "No";
$scholarship     = isset($_POST['scholarship']) ? "Yes" : "No";
$guardian_name   = mysqli_real_escape_string($conn, $_POST['guardian_name']);
$guardian_phone  = mysqli_real_escape_string($conn, $_POST['guardian_phone']);
$remarks         = mysqli_real_escape_string($conn, $_POST['remarks']);

$sql = "INSERT INTO students 
(fullname, email, phone, cnic, age, gender, rollno, department, semester, program, marks, sports, scholarship, guardian_name, guardian_phone, remarks)
VALUES 
('$fullname','$email','$phone','$cnic','$age','$gender','$rollno','$department','$semester','$program','$marks','$sports','$scholarship','$guardian_name','$guardian_phone','$remarks')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Student registered successfully! 🎓'); window.location.href='index.html';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
