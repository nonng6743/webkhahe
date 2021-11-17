<?php
require_once('connection.php');

session_start();




if (isset($_REQUEST['btn_login'])) {
    $email = strip_tags($_REQUEST['email']);
    $password = strip_tags($_REQUEST['password']);

    if (empty($email)) {
        $errorMsg[] = "Please enter username or email";
    } else if (empty($password)) {
        $errorMsg[] = "Please enter password";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT * FROM sellers WHERE  email = :uemail");
            $select_stmt->execute(array(':uemail' => $email));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0) {
                if ($email == $row['email']) {
                    if (md5($password, $row['password'])) {
                        $_SESSION['id_seller'] = $row['id_seller'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['lastname'] = $row['lastname'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['image'] = $row['image'];
                        $role = $row['role'];
                        $message = ("INSERT INTO login(typeuser) VALUES ('$role')");
                                                $stmt = $db->prepare($message);
                                                $stmt->execute();
                        $loginMsg = "เข้าสู่ระบบสำเร็จ";
                        header("refresh:2;dashboardseller.php");
                    } else {
                        $errorMsg[] = "พาสเวิร์ดผิด กรุณา ลองอีกครั้ง";
                    }
                } else {
                    $errorMsg[] = "ไม่พบอีเมลนี้ในระบบ กรุณาลองใหม่อีกครั้ง";
                }
            } else {
                $errorMsg[] = "ไม่พบอีเมลนี้ในระบบ กรุณาลองใหม่อีกครั้ง";
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php ?>
    <?php include './components/navbars.php' ?>
    <div class="hold-transition login-page">
        <div class="hold-transition login-page">
            <div class="login-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a href="../index.php" class="h1"><b>ตลาดเคหะ</b> K.6</a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">เข้าสู่ระบบ</p>

                        <form method="post">
                            <?php
                            if (isset($errorMsg)) {
                                foreach ($errorMsg as $error) {
                            ?>
                                    <div class="alert alert-danger">
                                        <strong><?php echo $error; ?></strong>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            if (isset($loginMsg)) {
                            ?>
                                <div class="alert alert-success">
                                    <strong><?php echo $loginMsg; ?></strong>
                                </div>
                            <?php
                            }
                            ?>
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
                                <button type="submit" name="btn_login" class="btn btn-primary btn-block">เข้าสู่ระบบสำหรับผู้ขาย</button>

                            </div>
                        </form>
                        
                        <p class="mb-0">
                            <a href="./signup.php" class="text-center">สมัครเป็นผู้ขาย</a>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.js"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="plugins/raphael/raphael.min.js"></script>
        <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
        <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
        <!-- ChartJS -->
        <script src="plugins/chart.js/Chart.min.js"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="dist/js/pages/dashboard2.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>