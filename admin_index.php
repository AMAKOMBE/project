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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>PSGAS</title>

    <style>
        @media (min-width:756px) {
            .navtoggle {
                display: none;
            }

            .logoutbtn {
                display: block;
            }
        }

        @media (max-width:756px) {
            .navtoggle {
                display: block;
            }

            .logoutbtn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <h1 style="font-size:1.5rem;color:white;">Admin portal</h1>
                <button class="navbar-toggler navtoggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="nav-link px-3 logoutbtn" href="logout.php" style="color:white;">Log out</a>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Admin portal</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="admin_index.php">
                                    <i class="bi bi-house"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="display_user.php">
                                    <i class="bi bi-people-fill"></i>
                                    User Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_report.php">
                                    <i class="bi bi-bar-chart-fill"></i>
                                    Data Report
                                </a>
                            </li>
                            <li class="nav-item mt-5">
                                <a class="nav-link px-3" href="logout.php" style="color: black;font-weight:bold;">Log out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin_index.php">
                                <i class="bi bi-house"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_user.php">
                                <i class="bi bi-people-fill"></i>
                                User Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_report.php">
                                <i class="bi bi-bar-chart-fill"></i>
                                Data Report
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">CURRENT COUNTRY STATISTICS</h1>
                </div>
                <div>
                    <?php
                    $con = mysqli_connect('localhost', 'root', '', 'project');
                    $sql = "SELECT COUNT(r_id) as num from reportinformation";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_driver = $row['num'];
                    ?>
                    <p style="font-size:120%;">The list of drivers of <b>september/october2022</b> shows the total number of drivers who worked the last 30 days, according to the
                        Rwanda transport development agency is <b><?php echo $total_driver; ?> drivers</b>. With the help of gathered driver information, below shows the current
                        statistics of driver performance basing on their <b><i>TRAVEL DISTANCE</i> , <i>TAPGO RECORD</i> , <i>ACCIDENT INVOLVEMENT</i>:
                    </p>
                </div>
                <div class="d-flex justify-content-around">
                    <div id="distancechart" style="width: 1800px; height: 475px;"></div>
                    <div id="tapgochart" style="width: 1800px; height: 475px;"></div>
                    <div id="accidentchart" style="width: 1800px; height: 475px;"></div>
                </div>

            </main>
        </div>
    </div>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Perfomance of Driver', 'Driver'],
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'project');
                $sql = "SELECT distinct COUNT(r_id) as num,travel_distance from reportinformation GROUP BY travel_distance";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . $row['travel_distance'] . "'," . $row['num'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Travels distance per driver status'
            };

            var chart = new google.visualization.PieChart(document.getElementById('distancechart'));

            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart1);

        function drawChart1() {

            var data = google.visualization.arrayToDataTable([
                ['Perfomance of Driver', 'Driver'],
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'project');
                $sql = "SELECT distinct COUNT(r_id) as num,tap_go from reportinformation GROUP BY tap_go";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . $row['tap_go'] . "'," . $row['num'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Tap_Go per driver status'
            };

            var chart = new google.visualization.PieChart(document.getElementById('tapgochart'));

            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {

            var data = google.visualization.arrayToDataTable([
                ['Perfomance of Driver', 'Driver'],
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'project');
                $sql = "SELECT distinct COUNT(r_id) as num,accidents from reportinformation GROUP BY accidents";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . $row['accidents'] . "'," . $row['num'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Accidents per driver status'
            };

            var chart = new google.visualization.PieChart(document.getElementById('accidentchart'));

            chart.draw(data, options);
        }
    </script>

</body>

</html>