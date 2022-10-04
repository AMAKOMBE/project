<?php

session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['province']) && !isset($_SESSION['district'])) {
    header('location:login_index.php');
}

$con = mysqli_connect('localhost', 'root', '', 'education');
$school = $_SESSION['username'];
$id = $_GET['updte'];
$sql = "select * from student where c_school_name like '$school' and s_id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$s_fname = htmlspecialchars($row['s_fname']);
$s_lname = htmlspecialchars($row['s_lname']);
$s_dob = $row['s_dob'];
$gender = $row['gender'];
$class_year = $row['class_year'];
$disability = htmlspecialchars($row['disability']);
$pr_school = htmlspecialchars($row['pr_school_name']);
$p_name = htmlspecialchars($row['p_name']);
$p_id = $row['p_id'];
$p_number = $row['p_number'];
$p_email = htmlspecialchars($row['p_email']);
$p_occupation = htmlspecialchars($row['p_occupation']);
$p_education = htmlspecialchars($row['p_education_level']);
$p_address = htmlspecialchars($row['p_address']);

if (isset($_POST['submit'])) {
    $id = $_GET['updte'];
    $s_fname = $_POST['fname'];
    $s_lname = $_POST['lname'];
    $s_dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $class_year = $_POST['classYear'];
    $disability = $_POST['disability'];
    $pr_school = $_POST['pr_school'];
    $p_name = $_POST['p_name'];
    $p_id = $_POST['p_id'];
    $p_number = $_POST['p_number'];
    $p_email = $_POST['p_email'];
    $p_occupation = $_POST['p_occupation'];
    $p_education = $_POST['p_education'];
    $p_address = $_POST['p_address'];
    $c_school = $_POST['c_school'];
    $c_province = $_POST['c_province'];
    $c_district = $_POST['c_district'];

    $sql = "update student set s_id=$id,class_year='$class_year',disability='$disability'
    ,p_name='$p_name',p_id='$p_id',p_number='$p_number',p_email='$p_email',
    p_occupation='$p_occupation',p_education_level='$p_education',p_address='$p_address'
    where s_id=$id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display_student.php');
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

<body style="background-image: url(driver.jpg); background-size: cover;">
    <div class="container">
        <div class="createUser-box">
            <div class="row my-5" style="margin:150px;">
                <div class="col-sm-12" style="background-color: white; height: 980px;padding: 3rem 1.3rem; position:relative; width: 100%;">
                    <form method="post">
                        <h3>Enter Student Information:</h3>
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>First Name:</b></label>
                                    <input type="text" name="fname" class="form-control" placeholder="first name" autocomplete="off" value="<?= $s_fname ?>" required readonly><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Date of Birth:</b></label>
                                    <input type="date" name="dob" class="form-control" value=<?php echo $s_dob; ?> required readonly><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Class Year:</b></label><br>
                                    <select name="classYear" required>
                                        <option value=<?php echo $class_year; ?>><?php echo $class_year; ?></option>
                                        <option value="P1">P1</option>
                                        <option value="P2">P2</option>
                                        <option value="P3">P3</option>
                                        <option value="P4">P4</option>
                                        <option value="P6">P5</option>
                                        <option value="P6">P6</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <br><label><b>Disability:</b></label>
                                    <input type="text" name="disability" class="form-control" placeholder="Complete if he/she has any disability, if not leave blank" autocomplete="off" value=<?php if ($disability) {
                                                                                                                                                                                                    echo $disability;
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "No-Disability";
                                                                                                                                                                                                } ?>><br>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>Last Name:</b></label>
                                    <input type="text" name="lname" class="form-control" placeholder="Last name" autocomplete="off" value="<?= $s_lname ?>" required readonly><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Gender:</b></label><br>
                                    <input type="text" name="gender" class="form-control" autocomplete="off" value=<?php echo $gender; ?> required readonly><br>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><b>Previous School Attended:</b></label>
                                    <input type="text" name="pr_school" class="form-control" placeholder="Enter Previous School Attended" autocomplete="off" value="<?= $pr_school ?>" required><br>
                                </div>
                            </div>
                        </div>
                        <h3>Enter Parent/Guardian Information:</h3>
                        <div class="form-group">
                            <label><b>Full Name:</b></label>
                            <input type="text" name="p_name" class="form-control" placeholder="Enter Full Name" autocomplete="off" value="<?= $p_name ?>" required><br>
                        </div>
                        <div class="form-group">
                            <label><b>Identification(ID/Passport):</b></label>
                            <input type="text" name="p_id" class="form-control" placeholder="Enter ID/Passport number" autocomplete="off" value=<?php echo $p_id; ?> required><br>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>Phone Number:</b></label>
                                    <input type="text" name="p_number" class="form-control" placeholder="start with country code(+XXXXXXXX)" autocomplete="off" value=<?php echo $p_number; ?> required><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Occupation:</b></label><br>
                                    <select name="p_occupation" required>
                                        <option value=<?php echo $p_occupation; ?>><?php echo $p_occupation; ?></option>
                                        <option value="none">None</option>
                                        <option value="public sector">Public Sector</option>
                                        <option value="private sector">Private Sector</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><b>Address:</b></label>
                                    <input type="text" name="p_address" class="form-control" placeholder="Enter Home Address" autocomplete="off" value="<?= $p_address ?>" required><br>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>Email:</b></label>
                                    <input type="text" name="p_email" class="form-control" placeholder="name@example.com" autocomplete="off" value=<?php echo $p_email; ?> required><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Education Level:</b></label><br>
                                    <select name="p_education" required>
                                        <option value=<?php echo $p_education; ?>><?php echo $p_education; ?></option>
                                        <option value="none">None</option>
                                        <option value="primary certificate">Primary Certificate</option>
                                        <option value="high school certificate">High school Certificate</option>
                                        <option value="bachelor degree">Bachelor Degree</option>
                                        <option value="masters degree">Master's Degree</option>
                                        <option value="doctorate degree">Doctorate Degree</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label><b>School Name:</b></label>
                            <input type="text" name="c_school" class="form-control" value="<?php echo $_SESSION['username']; ?>"><br>
                        </div>
                        <div class="form-group" hidden>
                            <label><b>Province:</b></label>
                            <input type="text" name="c_province" class="form-control" value="<?php echo $_SESSION['province']; ?>"><br>
                        </div>
                        <div class="form-group" hidden>
                            <label><b>District:</b></label>
                            <input type="text" name="c_district" class="form-control" value="<?php echo $_SESSION['district']; ?>"><br>
                        </div>
                        <button type="submit" class="btn btn-outline-success" name="submit">Update</button>
                        <a href="display_student.php" class="btn btn-outline-danger" role="button" aria-pressed="true">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>