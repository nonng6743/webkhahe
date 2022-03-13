<?php
require_once('connection.php');

session_start();


if (isset($_SESSION['id_user'])) {
    header("location: index.php");
}

if (isset($_REQUEST['btn_login'])) {
    $email = strip_tags($_REQUEST['email']);
    $password = strip_tags($_REQUEST['password'])
    
    
    
    
    ;

    if (empty($email)) {
        $errorMsg[] = "กรุณากรอกอีเมล";
    } else if (empty($password)) {
        $errorMsg[] = "กรุณากรอกพาสเวริ์ด";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT * FROM users WHERE  email = :uemail");
            $select_stmt->execute(array(':uemail' => $email));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0) {
                if ( $email == $row['email']) {
                    if (md5($password, $row['password'])) {
                        $_SESSION['id_user'] = $row['id_user'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['image'] = $row['image'];
                        $role = $row['role'];
                        
                        $message = ("INSERT INTO login(typeuser) VALUES ('$role')");
                                                $stmt = $db->prepare($message);
                                                $stmt->execute();
                        
                        $loginMsg = "เข้าสู่ระบบสำเร็จ...";
                        header("refresh:2;index.php");
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="./seller/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./seller/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="./seller/dist/css/adminlte.min.css">
</head>

<body>
    <?php include './components/Navbar.php' ?>
    <div class="hold-transition login-page">
        <div class="hold-transition login-page">
            <div class="login-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a href="./" class="h1"><b>ตลาดเคหะ</b>คลองหก</a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">เข้าสู่ระบบ</p>

                        <form action="" method="post">
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



                             <div class="social-auth-links text-center mt-2 mb-3">
                                <button type="submit" name="btn_login" class="btn btn-success btn-block">เข้าสู่ระบบ</button>
                                <?php 
                                ini_set('display_errors', 1);
                                require_once('./components/facebook-sdk-v5/autoload.php');
                                
                                $fb = new Facebook\Facebook([
                                    'app_id' => '231959892239714',
                                    'app_secret' => 'f8c350ac1f149c5e4ce5ba3f05740856',
                                    'default_graph_version' => 'v2.5',
                                ]);
                                $helper = $fb->getRedirectLoginHelper();
                                $permissions = ['email', 'user_likes'];
                                $loginUrl = $helper->getLoginUrl('https://xn--12cfam3m8adoy1n.online/signin-callback.php', $permissions);
                                echo '<a href="' . $loginUrl . '" class="btn btn-block btn-primary">
                                        <i class="fab fa-facebook mr-2"></i> เข้าสู่ระบบด้วย Facebook
                                    </a>'
                                ?>
                                
                            </div>
                        </form>
                        <!-- /.social-auth-links -->

                        <p class="mb-1">
                            <a href="/">กลับสู่หน้าแรก</a>
                        </p>
                        <p class="mb-0">
                            <a href="./signup.php" class="text-center">สมัครสมาชิกใหม่</a>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="./seller/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="./seller/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="./seller/dist/js/adminlte.min.js"></script>
    </div>
</body>

</html>