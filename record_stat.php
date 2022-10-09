<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'project');

if (isset($_POST['submit'])) {

    $id = $_GET['record'];
    $check = "select * from driverinfo where d_id like '$id'";

    $res = mysqli_query($con, $check);
    $row = mysqli_fetch_assoc($res);
    $r_id = $row['reg_id'];
    if ($res) {

        $travel_distance = $_POST['travel_distance'];
        $tap_go = $_POST['tap_go'];
        $accidents = $_POST['accidents'];
        $month = $_POST['month'];

        $sql = "INSERT INTO reportinfo (r_id,travel_distance,tap_go,accidents,month) 
        VALUES ('$r_id','$travel_distance','$tap_go','$accidents','$month'";

        $result = mysqli_query($con, $sql);

        if ($result) {
            header('location:display_driver.php');
        } else {
            die(mysqli_error($con));
        }
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

<body style="background-image: url(driver.jpg); background-size: cover;">
    <div class="container">
        <div class="createUser-box">
            <div class="row my-5" style="margin:150px;">
                <div class="col-sm-12" style="background-color: white; height: 880px;padding: 3rem 1.3rem; position:relative; width: 100%;">
                    <form method="post">
                        <h3>RECORD MONTHLY STATS:</h3><br> <b>
                            <div class="row justify-content-between">
                                <div>
                                    <div class="form-group">
                                        <label><b>Travel Distance:</b></label>
                                        <input type="text" name="travel_distance" class="form-control" placeholder="Enter Total Travelled Distance" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Tap-Go:</b></label>
                                        <input type="text" name="tap_go" class="form-control" placeholder="Enter Total Tap-Go" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Accidents:</b></label>
                                        <input type="text" name="accidents" class="form-control" placeholder="Enter Total Accidents" autocomplete="off" required><br>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Month:</b></label><br>
                                        <select name="month" required>
                                            <option value="january">January</option>
                                            <option value="february">February</option>
                                            <option value="march">March</option>
                                            <option value="april">April</option>
                                            <option value="may">May</option>
                                            <option value="june">June</option>
                                            <option value="july">July</option>
                                            <option value="august">August</option>
                                            <option value="september">September</option>
                                            <option value="october">October</option>
                                            <option value="november">November</option>
                                            <option value="december">December</option>
                                        </select>
                                    </div><br>
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