<?php

session_start();
if (!isset($_SESSION['user_name'])) {
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
                            <a class="nav-link" aria-current="page" href="admin_index.php">
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
                            <a class="nav-link active" href="admin_report.php">
                                <i class="bi bi-bar-chart-fill"></i>
                                Data Report
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">STATISTICAL DETAILED REPORT</h1>
                </div>
                <span><a href="admin_report.php" class="btn btn-outline-secondary">Province Level</a></span>
                <span><a href="admin_report_d.php" class="btn btn-outline-secondary active">District Level</a></span><br>
                <br>
                <div id="OccupationChart_d" style="width: 100%; height: 1000px;"></div><br>
                <div id="EducationChart_d" style="width: 100%; height: 1000px;"></div>
            </main>
        </div>
    </div>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Districts', 'Unemployeed', 'Public Sector', 'Private Sector'],
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'project');
                $sql = "SELECT c_district,count(p_id) as num from student where p_occupation like 'none' GROUP by c_district";
                $sql1 = "SELECT c_district,count(p_id) as num from student where p_occupation like 'public sector' GROUP by c_district";
                $sql2 = "SELECT c_district,count(p_id) as num from student where p_occupation like 'private sector' GROUP by c_district";
                $result = mysqli_query($con, $sql);
                $result1 = mysqli_query($con, $sql1);
                $result2 = mysqli_query($con, $sql2);
                $rowname = [];
                $row = [];
                $row1 = [];
                $row2 = [];
                while ($ro = mysqli_fetch_assoc($result)) {
                    $rowname[] = $ro['c_district'];
                    $row[] = $ro['num'];
                }
                while ($ro1 = mysqli_fetch_assoc($result1)) {
                    $row1[] = $ro1['num'];
                }
                while ($ro2 = mysqli_fetch_assoc($result2)) {
                    $row2[] = $ro2['num'];
                }
                $c = count($row);
                $a = 0;
                while ($a < $c) {
                    echo "['" . $rowname[$a] . "'," . $row[$a] . "," . $row1[$a] . "," . $row2[$a] . "], ";
                    $a = $a + 1;
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Guardian/Parent Occupation Status',
                    subtitle: 'This displays the occupation status of Parents/Guardians who has student in primary school on District level:',
                },
                bars: 'horizontal'
            };

            var chart = new google.charts.Bar(document.getElementById('OccupationChart_d'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        google.charts.setOnLoadCallback(drawChart1);

        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Districts', 'No Education or High School level only', 'Bachelor Degree', 'Masters Degree', 'Doctorate Degree'],
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'project');
                $sql = "SELECT c_district,count(p_id) as num from student where p_education_level in ('none','high school certificate') GROUP by c_district";
                $sql1 = "SELECT c_district,count(p_id) as num from student where p_education_level like 'bachelor degree' GROUP by c_district";
                $sql2 = "SELECT c_district,count(p_id) as num from student where p_education_level like 'masters degree' GROUP by c_district";
                $sql3 = "SELECT c_district,count(p_id) as num from student where p_education_level like 'doctorate degree' GROUP by c_district";
                $result = mysqli_query($con, $sql);
                $result1 = mysqli_query($con, $sql1);
                $result2 = mysqli_query($con, $sql2);
                $result3 = mysqli_query($con, $sql3);
                $rowname = [];
                $row = [];
                $row1 = [];
                $row2 = [];
                $row3 = [];
                while ($ro = mysqli_fetch_assoc($result)) {
                    $rowname[] = $ro['c_district'];
                    $row[] = $ro['num'];
                }
                while ($ro1 = mysqli_fetch_assoc($result1)) {
                    $row1[] = $ro1['num'];
                }
                while ($ro2 = mysqli_fetch_assoc($result2)) {
                    $row2[] = $ro2['num'];
                }
                while ($ro3 = mysqli_fetch_assoc($result3)) {
                    $row3[] = $ro3['num'];
                }
                $c = count($row);
                $a = 0;
                while ($a < $c) {
                    echo "['" . $rowname[$a] . "'," . $row[$a] . "," . $row1[$a] . "," . $row2[$a] . "," . $row3[$a] . "], ";
                    $a = $a + 1;
                }
                ?>
            ]);

            var options = {
                chart: {
                    title: 'Guardian/Parent Education Level',
                    subtitle: 'This displays the education level of Parents/Guardians who has student in primary school on District level:',
                },
                bars: 'horizontal'
            };

            var chart = new google.charts.Bar(document.getElementById('projectChart_d'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</body>

</html>