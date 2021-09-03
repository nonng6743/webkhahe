<?php
include_once('functions.php');
$userdata = new DB_con();

if (isset($_POST['submit'])) {
    $fastname = $_POST['fastname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $sql = $userdata->registration($fastname, $lastname, $email, $password, $gender, $phone);
    if ($sql) {
        echo "<script>alert('Ragistor Successfull')</script>";
        echo "<script>window.location.href='signin.php'</script>";
    } else {
        echo "<script>alert('Something went wrong! Please try again...')</script>";
        echo "<script>window.location.href='signup.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="./seller/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./seller/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="./seller/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <?php include './seller/components/Navbar.php' ?>
    <div class="hold-transition register-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="./" class="h1"><b>Kheha</b> K.6</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">สมัครสมาชิก</p>

                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="fastname" class="form-control" placeholder="fastname" id='fastname' name="fastname">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="lastname" class="form-control" placeholder="lastname" id='lastname' name="lastname">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" id='email' name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" id='password' name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            Gender
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" type="gender" id='gender' name="gender">
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            Phone Number
                        </div>
                        <div class="input-group mb-3">
                            <input type="phone" class="form-control" placeholder="phone" id='phone' name="phone">
                        </div>
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Up</button>
                            <a href="#" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                            </a>
                            <a href="#" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="./seller/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./seller/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./seller/dist/js/adminlte.min.js"></script>
</body>

</html>