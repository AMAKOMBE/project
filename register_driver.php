<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['submit'])) {
    $d_name = $_POST['d_name'];
    $phone_number = $_POST['phone_number'];
    $d_id = $_POST['d_id'];
    $reg_id = $_POST['reg_id'];
    $d_address = $_POST['d_address'];
    $plate_number = $_POST['plate_number'];
    $d_zone = $_POST['d_zone'];
    $company_name = $_POST['company_name'];
    
    $sql = "INSERT INTO driverinfo (d_name,phone_number,d_id,reg_id,d_address,plate_number,d_zone,company_name) 
    VALUES ('$d_name','$phone_number','$d_id','$reg_id','$d_address','$plate_number','$d_zone','$company_name')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display_driver.php');
    } else {
        die(mysqli_error($con));
    }
}
