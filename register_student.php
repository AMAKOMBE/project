<?php

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login_index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['submit'])) {
    $id = $_POST['d_id'];
    $name = $_POST['d_name'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['d_address'];
    $plateNumber = $_POST['plateNumber'];
    $zone = $_POST['d_zone'];
    

    $sql = "insert into driver (id,name,phoneNumber,address,plateNumber,d_zone)
    values('$d_id','$d_name','$phoneNumber','$d_address','$plateNumber','$d_zone')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display_student.php');
    } else {
        die(mysqli_error($con));
    }
}
