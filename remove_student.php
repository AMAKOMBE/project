<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'education');

if (isset($_GET['rmve'])) {
    $id = $_GET['rmve'];

    $sql = "delete from student where s_id=$id";
    $result = mysqli_query($con,$sql);

    if($result){
        header('location:display_student.php');
    }else{
        die(mysqli_error($con));
    }
}
