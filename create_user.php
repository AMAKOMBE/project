<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_index.php');
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
                    <form action="register_user.php" method="post">
                        <div class="form-group">
                            <label><b>User Name:</b></label>
                            <input type="text" name="user_name" class="form-control" placeholder="Enter Company Name" autocomplete="off" required><br>
                        </div>
                        <div class="form-group">
                            <label><b>Email:</b></label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Company Email" autocomplete="off" required><br>
                        </div>
                        <div class="form-group">
                            <label><b>Province:</b></label><br>
                            <select name="province">
                                <option value="East Province">East Province</option>
                                <option value="Kigali">Kigali</option>
                                <option value="North Province">North Province</option>
                                <option value="South Province">South Province</option>
                                <option value="West Province">West Province</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <br><label><b>Contact:</b></label>
                            <input type="text" name="contact" class="form-control" placeholder="start with (0XXXXXXXX)" autocomplete="off" required><br>
                        </div>
                        <div class="form-group">
                            <label><b>Password:</b></label>
                            <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="off" required><br>
                        </div>
                        <button type="submit" class="btn btn-outline-success" name="submit">Submit</button>
                        <a href="display_user.php" class="btn btn-outline-danger" role="button" aria-pressed="true">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>