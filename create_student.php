<?php

session_start();
if (!isset($_SESSION['user_name']) && !isset($_SESSION['province']) && !isset($_SESSION['district'])) {
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
                    <form action="register_student.php" method="post">
                        <h3>Enter Student Information:</h3>
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>First Name:</b></label>
                                    <input type="text" name="fname" class="form-control" placeholder="first name" autocomplete="off" required><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Date of Birth:</b></label>
                                    <input type="date" name="dob" class="form-control" required><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Class Year:</b></label><br>
                                    <select name="classYear" required>
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
                                    <input type="text" name="disability" class="form-control" placeholder="Complete if he/she has any disability, if not leave blank" autocomplete="off"><br>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>Last Name:</b></label>
                                    <input type="text" name="lname" class="form-control" placeholder="Last name" autocomplete="off" required><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Gender:</b></label><br>
                                    <select name="gender" required>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><b>Previous School Attended:</b></label>
                                    <input type="text" name="pr_school" class="form-control" placeholder="Enter Previous School Attended" autocomplete="off" required><br>
                                </div>
                            </div>
                        </div>
                        <h3>Enter Parent/Guardian Information:</h3>
                        <div class="form-group">
                            <label><b>Full Name:</b></label>
                            <input type="text" name="p_name" class="form-control" placeholder="Enter Full Name" autocomplete="off" required><br>
                        </div>
                        <div class="form-group">
                            <label><b>Identification(ID/Passport):</b></label>
                            <input type="text" name="p_id" class="form-control" placeholder="Enter ID/Passport number" autocomplete="off" required><br>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>Phone Number:</b></label>
                                    <input type="text" name="p_number" class="form-control" placeholder="start with country code(+XXXXXXXX)" autocomplete="off" required><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Occupation:</b></label><br>
                                    <select name="p_occupation" required>
                                        <option value="none">None</option>
                                        <option value="public sector">Public Sector</option>
                                        <option value="private sector">Private Sector</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><b>Address:</b></label>
                                    <input type="text" name="p_address" class="form-control" placeholder="Enter Home Address" autocomplete="off" required><br>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label><b>Email:</b></label>
                                    <input type="text" name="p_email" class="form-control" placeholder="name@example.com" autocomplete="off" required><br>
                                </div>
                                <div class="form-group">
                                    <label><b>Education Level:</b></label><br>
                                    <select name="p_education" required>
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
                        <button type="submit" class="btn btn-outline-success" name="submit">Submit</button>
                        <a href="display_student.php" class="btn btn-outline-danger" role="button" aria-pressed="true">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>