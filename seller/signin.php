<?php
session_start();
include_once('../functions.php');
$userdata = new DB_con();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = $userdata->signinseller($email, $password);
    $num = mysqli_fetch_array($result);

    if ($num > 0) {
        $_SESSION['id_seller'] = $num['id_seller'];
        $_SESSION['fastname'] = $num['fastname'];
        $_SESSION['lastname'] = $num['lastname'];
        $_SESSION['role'] = $num['role'];

        echo "<script>alert('Login Successfull')</script>";
        echo "<script>window.location.href='../seller/dashboardseller.php'</script>";
    } else {
        echo "<script>alert('Something went wrong! Please try again...')</script>";
        echo "<script>window.location.href='../seller/signin.php'</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php ?>
    <div class="container">
        <h1 class="mt-5">เข้าสู่ระบบ</h1>
        <hr>
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id='email' name="email">
                <span id="emailavailable"></span>
                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="password" class="form-control" id='password' name="password">
                </div>

                <button type="submit" name="login" class="btn btn-success">เข้าสู่ระบบ</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>