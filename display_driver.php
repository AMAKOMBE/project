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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
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
                                <a class="nav-link" aria-current="page" href="web_index.php">
                                    <i class="bi bi-house"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="display_driver.php">
                                    <i class="bi bi-people-fill"></i>
                                    Driver Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="web_report.php">
                                    <i class="bi bi-bar-chart-fill"></i>
                                    Company Stats
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
                            <a class="nav-link" aria-current="page" href="web_index.php">
                                <i class="bi bi-house"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="display_driver.php">
                                <i class="bi bi-people-fill"></i>
                                Driver Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="web_report.php">
                                <i class="bi bi-bar-chart-fill"></i>
                                Company Stats
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
                <h4 class="text-center alert alert-info">DRIVER INFORMATION</h4>
                <span><a href="create_driver.php" class="btn btn-primary">Add Driver</a></span><br>
                <br>
                <table class="table my-3" width="100%" id="student_table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">ID</th>
                            <th scope="col">Number</th>
                            <th scope="col">Plate Number</th>
                            <th scope="col">Zone</th>
                            <th scope="col">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $con = mysqli_connect('localhost', 'root', '', 'project');
                        $name = $_SESSION['username'];
                        $sql = "select * from driverinfo where company_name like '$name' order by plate_number asc";
                        $result = mysqli_query($con, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $fname = $row['d_name'];
                                $number = $row['phone_number'];
                                $id = $row['d_id'];
                                $reg_number = $row['reg_id'];
                                $address = $row['d_address'];
                                $plate = $row['plate_number'];
                                $zone = $row['d_zone'];
                                echo '
                                    <tr>
                                    <td>' . $fname . '</td>
                                    <td>' . $number . '</td>
                                    <td>' . $id . '</td>
                                    <td>' . $reg_number . '</td>
                                    <td>' . $plate . '</td>
                                    <td>' . $zone . '</td>
                                    <td>
                                    <button class="btn btn-primary"><a href="record_stat.php?record=' . $reg_number. '"
                                    class="text-light">Record</a></button>
                                    </td>
                                    </tr>
                                    ';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
            </main>
            </main>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#student_table').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "all"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Driver",
                }
            });
        });
    </script>

</body>

</html>