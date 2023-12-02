<?php

$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("components/dbConnect.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Check whether the number is Exists
    $exisSql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $exisSql);
    if (mysqli_num_rows($result) > 0) {
        $showError = "Username alredy exists";
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($cpassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Password do not match";
        }
    }
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php require 'components/nav.php' ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your Registration is successfull.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed</strong> ' . $showError . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center">Signup to our web site</h1>
        <form action="signUp.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>