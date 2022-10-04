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
            .logoutbtn{
                display:block;
            }
        }

        @media (max-width:756px) {
            .navtoggle {
                display: block;
            }
            .logoutbtn{
                display:none;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <h1 style="font-size:1.5rem;color:white;">Web Portal</h1>
                <button class="navbar-toggler navtoggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="nav-link px-3 logoutbtn" href="logout.php" style="color:white;">Log out</a>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Web Portal</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="web_index.php">
                                    <i class="bi bi-house"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="display_student.php">
                                    <i class="bi bi-people-fill"></i>
                                    Student Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="web_report.php">
                                    <i class="bi bi-bar-chart-fill"></i>
                                    School Stats
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
                            <a class="nav-link active" aria-current="page" href="web_index.php">
                                <i class="bi bi-house"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_student.php">
                                <i class="bi bi-people-fill"></i>
                                Student Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="web_report.php">
                                <i class="bi bi-bar-chart-fill"></i>
                                School Stats
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?php echo $_SESSION['username']; ?> Current Status</h1>
                </div>
                <div>
                    <?php
                    $con = mysqli_connect('localhost', 'root', '', 'education');
                    $school = $_SESSION['username'];
                    $sql = "SELECT distinct COUNT(s_id) as num from student where c_school_name like '$school'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_student = $row['num'];
                    ?>
                    <p style="font-size:120%;">As of the Academic year of <b>2021/2022</b> shows the total number of student attending <?php echo $_SESSION['username']; ?>
                        are <b><?php echo $total_student; ?></b> students. With the help of student information, below shows the current
                        statistics of student Parent's or Guardian's basing on their <i>Employment status</i> and <i>Education level status</i>:
                    </p>
                </div>
                <div class="d-flex justify-content-around">
                    <div id="Occupationchart_s" style="width: 1800px; height: 475px;"></div>
                    <div id="Educationchart_s" style="width: 1800px; height: 475px;"></div>
                </div>

            </main>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Guardian/Parent Occupation', 'students'],
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'education');
                $school = $_SESSION['username'];
                $sql = "SELECT distinct COUNT(p_id) as num,p_occupation from student where c_school_name like '$school' GROUP BY p_occupation";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . $row['p_occupation'] . "'," . $row['num'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Guardian/Parent Employment status'
            };

            var chart = new google.visualization.PieChart(document.getElementById('Occupationchart_s'));

            chart.draw(data, options);
        }

        google.charts.setOnLoadCallback(drawChart1);

        function drawChart1() {

            var data = google.visualization.arrayToDataTable([
                ['Guardian/Parent Education Level', 'students'],
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'education');
                $school = $_SESSION['username'];
                $sql = "SELECT distinct COUNT(p_id) as num,p_education_level from student where c_school_name like '$school' GROUP BY p_education_level";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . $row['p_education_level'] . "'," . $row['num'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Guardian/Parent Education Level status'
            };

            var chart = new google.visualization.PieChart(document.getElementById('Educationchart_s'));

            chart.draw(data, options);
        }
    </script>
</body>

</html>