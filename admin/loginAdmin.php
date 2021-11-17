<?php
session_start();
include_once('../functions.php');
$userdata = new DB_con();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = $userdata->signinadmin($email, $password);
    $num = mysqli_fetch_array($result);

    if ($num > 0) {
        $_SESSION['id_admin'] = $num['id_admin'];
        $_SESSION['firstname'] = $num['firstname'];
        $_SESSION['lastname'] = $num['lastname'];
        $_SESSION['role'] = $num['role'];
        echo "<script>alert('Login Successfull')</script>";
        echo "<script>window.location.href='dashboard.php'</script>";
    } else {
        echo "<script>alert('Something went wrong! Please try again...')</script>";
        echo "<script>window.location.href='loginAdmin.php'</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าเข้าสู่ระบบ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../seller/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../seller/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../seller/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body class="hold-transition login-page">
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="../" class="h1"><b>ตลาดเคหะ K.6</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">หน้าเข้าสู่ระบบแอดมิน</p>

                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="อีเมล" id='email' name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="พาสเวิร์ด" id='password' name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <button type="submit" name="login" class="btn btn-primary btn-block">เข้าสู่ระบบสำหรับแอดมิน</button>
                            <br/>
                            <a href="../" >
                                 กลับไปหน้าเเรก
                            </a>
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="../seller/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../seller/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../seller/dist/js/adminlte.min.js"></script>
</body>

</html>