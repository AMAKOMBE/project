<?php

session_start();

$con = mysqli_connect('localhost','root','','project');

$username = $_POST['user_name'];
$password = $_POST['password'];

$s = " select * from userinformation where user_name = '$username' && passkey = '$password'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['user_name'];
    if($username == 'admin'){
        header('location:admin_index.php');
    }else{
        header('location:web_index.php');
    }
} else {
    header('location:login_index.php');
}

?>
