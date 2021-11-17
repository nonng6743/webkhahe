<?php
require_once('connection.php');

if (isset($_REQUEST['btn_register'])) {
    $firstname = strip_tags($_REQUEST['firstname']);
    $lastname = strip_tags($_REQUEST['lastname']);
    $email = strip_tags($_REQUEST['txt_email']);
    $password = strip_tags($_REQUEST['password']);
    $gender = strip_tags($_REQUEST['gender']);
    $phone = strip_tags($_REQUEST['phone']);


    if (empty($firstname)) {
        $errorMsg[] = "Please enter firstname";
    } elseif (empty($lastname)) {
        $errorMsg[] = "Please enter lastname";
    } elseif (empty($email)) {
        $errorMsg[] = "Please enter email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "Please enter a valid email address";
    } elseif (empty($password)) {
        $errorMsg[] = "Please enter password";
    } elseif (strlen($password) < 6) {
        $errorMsg[] = "Please must be atleast 6 characters";
    } elseif (empty($gender)) {
        $errorMsg[] = "Please enter gender";
    } elseif (empty($phone)) {
        $errorMsg[] = "Please enter phone";
    } elseif (strlen($phone) < 10) {
        $errorMsg[] = "Please must be atleast 10 Number";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT email FROM users WHERE   email = :uemail");
            $select_stmt->execute(array(':uemail' => $email));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                if ($row['email'] == $email) {
                    $errorMsg[] = "Sorry email already exists";
                }
            }
             elseif (!isset($errorMsg)) {
                $new_password = md5($password);
                $insert_stml = $db->prepare("INSERT INTO users (firstname,lastname,email,password,gender,phone) VALUES (:ufirstname, :ulastname, :uemail, :upassword, :ugender, :uphone )");
                if ($insert_stml->execute(array(
                    ':ufirstname' => $firstname,
                    ':ulastname' => $lastname,
                    ':uemail' => $email,
                    ':upassword' => $new_password,
                    ':ugender' => $gender,
                    ':uphone' => $phone,
                ))) {
                    echo "<script>alert('Ragistor Successfull')</script>";
                    echo "<script>window.location.href='signin.php'</script>";
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
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

<body>
    
        <div class="hold-transition register-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="./" class="h1"><b>ตลาดเคหะ</b> K.6</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">สมัครสมาชิก</p>
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
                        <div class="input-group mb-3">
                            <input type="firstname" class="form-control" placeholder="ชื่อ" id='firstname' name="firstname">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="lastname" class="form-control" placeholder="นามสกุล" id='lastname' name="lastname">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="อีเมล" id='email' name="txt_email">
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
                        <div class="input-group mb-3">
                            เพศ
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-select" type="gender" id='gender' name="gender">
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                           เบอร์โทรศัพท์
                        </div>
                        <div class="input-group mb-3">
                            <input type="phone" class="form-control" placeholder="เบอร์โทรศัพท์" id='phone' name="phone">
                        </div>
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <button type="submit" name="btn_register" class="btn btn-primary btn-block" value="Register">สมัครสมาชิก</button>
                        </div>
                        <a href="./signin.php">
                            หน้าเข้าสู่ระบบ
                        </a>
                        <br />
                        <a href="./">
                            กลับสู่หน้าแรก
                        </a>
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