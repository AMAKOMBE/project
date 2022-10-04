<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'project');


if (isset($_POST['submit'])) {

    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    $contact = $_POST['contact'];
    $pass = $_POST['pass'];

    $sql = "INSERT INTO userinformation (user_name,user_email,province,user_contact,passkey)
    VALUES ('$user_name','$email','$province','$contact','$pass')";
    $result = mysqli_query($con, $sql);
    
    if($result){
        header('location:display_user.php');
    }else{
        die(mysqli_error($con));
    }
}
