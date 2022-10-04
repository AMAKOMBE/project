<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'project');
$user = $_SESSION['username'];
$id = $_GET['userUpdate'];
$sql = "select * from userinformation where id =$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$id = htmlspecialchars($row['id']);
$name = htmlspecialchars($row['user_name']);
$email = htmlspecialchars($row['user_email']);
$province = htmlspecialchars($row['province']);
$contact = htmlspecialchars($row['user_contact']);
$password = htmlspecialchars($row['passkey']);

if (isset($_POST['submit'])) {
    $id = $_GET['userUpdate'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    $contact = $_POST['contact'];
    $pass = $_POST['pass'];

    $sql = "update userinformation set user_name='$user_name',user_email='$email'
    ,province='$province',user_contact='$contact',passkey='$pass' where id=$id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display_user.php');
    } else {
        die(mysqli_error($con));
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" type="text/css" href="signin.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>PSGAS</title>
</head>

<body style="background-image: url(pencil.jpg); background-size: cover;">
    <div class="container">
        <div class="registerUser-box">
            <div class="row my-5" style="margin:150px;">
                <div class="col-sm-12" style="background-color: white; height: 650px;padding: 3rem 1.3rem; position:relative; width: 100%;">
                    <form method="post">
                        <div class="form-group">
                            <label><b>Company Name:</b></label>
                            <input type="text" name="user_name" class="form-control" placeholder="Enter Company Name" autocomplete="off" value="<?= $name ?>" required readonly><br>
                        </div>
                        <div class="form-group">
                            <label><b>Email:</b></label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Company Email" autocomplete="off" value="<?= $email ?>" required><br>
                        </div>
                        <div class="form-group">
                            <label><b>Province:</b></label><br>
                            <input type="text" name="province" class="form-control" placeholder="province" autocomplete="off" value="<?= $province ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <br><label><b>Contact:</b></label>
                            <input type="text" name="contact" class="form-control" placeholder="start with (0XXXXXXXX)" autocomplete="off" value="<?= $contact ?>" required><br>
                        </div>
                        <div class="form-group">
                            <label><b>Password:</b></label>
                            <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="off" value="<?= $password ?>" required><br>
                        </div>
                        <button type="submit" class="btn btn-outline-success" name="submit">Update</button>
                        <a href="display_user.php" class="btn btn-outline-danger" role="button" aria-pressed="true">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>