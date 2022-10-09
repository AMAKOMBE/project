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
        <div class="createUser-box">
            <div class="row my-5" style="margin:150px;">
                <div class="col-sm-12" style="background-color: white; height: 980px;padding: 3rem 1.3rem; position:relative; width: 100%;">
                    <form action="register_driver.php" method="post">
                        <h3>Enter Driver Information:</h3><br> <b>
                            <div class="row justify-content-between">
                                <div>
                                    <div class="form-group">
                                        <label><b>Driver Name:</b></label>
                                        <input type="text" name="d_name" class="form-control" placeholder="Full name" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Phone Number:</b></label>
                                        <input type="text" name="phone_number" class="form-control" placeholder="start with (0XXXXXXXX)" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>National ID:</b></label>
                                        <input type="num" name="d_id" class="form-control" placeholder="Driver Identification" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Registration Number:</b></label>
                                        <input type="num" name="reg_id" class="form-control" placeholder="Driver Identification" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Address:</b></label>
                                        <input type="text" name="d_address" class="form-control" placeholder="Driver address" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Plate Number:</b></label>
                                        <input type="text" name="plate_number" class="form-control" placeholder="start with (RXXXXXX)" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Driver Zone:</b></label>
                                        <input type="text" name="d_zone" class="form-control" placeholder="Driver Zone" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label><b>Company Name:</b></label>
                                        <input type="text" name="company_name" class="form-control" value="<?php echo $_SESSION['username']; ?>"><br>
                                    </div>
                                    <button type="submit" class="btn btn-outline-success" name="submit">Submit</button>
                                    <a href="display_driver.php" class="btn btn-outline-danger" role="button" aria-pressed="true">Cancel</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>