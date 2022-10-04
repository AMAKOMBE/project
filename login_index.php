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

    <style>
        @media (max-width:756px){
            .form-container{
                width: 80% !important;
            }}
    </style>
</head>

<body>
    <img src="./logo_rtda_rw.jpg" alt="rtda logo" style="width:15rem;height:12rem;margin: 0 auto;display:block;">
    <div class="container mt-5 form-container" style="width:50%;background-color: #E4EEE4;padding: 3rem 1.3rem; position: absolute; top:50%;left:50%;transform:translate(-50%,-50%);">

        <form action="validation.php" method="post">
            <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
            <div class="form-group my-3">
                <label for="floatingInput">Username</label>
                <input type="text" name="user_name" class="form-control" placeholder="username" required>
            </div>
            <div class="form-group my-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>
    </div>

</body>

</html>