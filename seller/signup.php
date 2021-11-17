<?php

require_once('connection.php');

if (isset($_REQUEST['submit'])) {
    try {
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $birthday = $_REQUEST['birthday'];
        $gender = $_REQUEST['gender'];
        $idcard = $_REQUEST['idcard'];
        $phone = $_REQUEST['phone'];
        $role = "noseller";

        $image_file = $_FILES['txt_file']['name'];
        $type = $_FILES['txt_file']['type'];
        $size = $_FILES['txt_file']['size'];
        $temp = $_FILES['txt_file']['tmp_name'];

        $path = "../upload/seller/" . $image_file; // set upload folder path

        if (empty($firstname)) {
            $errorMsg = "กรุณาใส่ช่องชื่อจริง";
        } else if (empty($lastname)) {
            $errorMsg = "กรุณาใส่นามสกุล";
        } else if (empty($email)) {
            $errorMsg = "กรุณาใส่ email";
        } else if (empty($password)) {
            $errorMsg = "กรุณาใส่ password";
        } elseif (strlen($password) < 6) {
            $errorMsg[] = "ต้องใส่รหัสผ่าน 6 ตัวขึ้นไป";
        } else if (empty($birthday)) {
            $errorMsg = "กรุณาระบุวันเกิดของท่าน";
        } else if (empty($gender)) {
            $errorMsg = "กรุณาระบุเพศของท่าน";
        } else if (empty($idcard)) {
            $errorMsg = "กรุณาระบุรหัสบัตรประชาชนของท่าน";
        } elseif (strlen($idcard) < 13) {
            $errorMsg[] = "กรุณาระบุรหัสบัตรประชาชนให้ครบ 13 หลัก";
        } else if (empty($phone)) {
            $errorMsg = "กรุณาระบุเบอร์โทรศัทพ์ของท่าน";
        } elseif (strlen($phone) < 10) {
            $errorMsg[] = "กรุณาระบุเบอร์โทรศัทพ์ให้ครบ 10 ตัว";
        } else if (empty($image_file)) {
            $errorMsg = "กรุณาอัพโหลดรูปภาพของท่าน";
        } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
            if (!file_exists($path)) { // check file not exist in your upload folder path
                if ($size < 5000000) { // check file size 5MB
                    move_uploaded_file($temp, '../upload/seller/'.$image_file); // move upload file temperory directory to your upload folder
                } else {
                    $errorMsg = "กรุณาอัพโหลดรูปภาพที่มีขนาดไม่เกิน 5MB"; // error message file size larger than 5mb
                }
            } else {
                $errorMsg = "มีชื่อภาพนี้อยู่ในระบบเเล้ว"; // error message file not exists your upload folder path
            }
        } else {
            $errorMsg = "กรุณาอัพโหลดภาพที่นามสกุล JPG, JPEG, PNG & G...";
        }

        if (!isset($errorMsg)) {
            $new_password = md5($password);
            $insert_stmt = $db->prepare('INSERT INTO sellers(firstname,lastname,email,password,birthday,gender,idcard,phone,image,role) VALUES (:ffirstname,:flastName,:femail,:fpassword,:fbirthday,:fgender,:fidcard,:fphone, :fimage,:frole)');
            $insert_stmt->bindParam(':ffirstname', $firstname);
            $insert_stmt->bindParam(':flastName', $lastname);
            $insert_stmt->bindParam(':femail', $email);
            $insert_stmt->bindParam(':fpassword', $new_password);
            $insert_stmt->bindParam(':fbirthday', $birthday);
            $insert_stmt->bindParam(':fgender', $gender);
            $insert_stmt->bindParam(':fidcard', $idcard);
            $insert_stmt->bindParam(':fphone', $phone);
            $insert_stmt->bindParam(':fimage', $image_file);
            $insert_stmt->bindParam(':frole', $role);

            if ($insert_stmt->execute()) {
                $insertMsg = "สมัครสำเร็จ ....";
                header('refresh:2;signin.php');
            }
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครเป็นผู้ขาย</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <?php include './components/navbars.php' ?>
    <section class="vh-100 bg-image">
        <br/>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">สมัครเพื่อขายสินค้ากับเรา</h2>

                                <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <?php
                                    if (isset($errorMsg)) {
                                    ?>
                                        <div class="alert alert-danger">
                                            <strong><?php echo $errorMsg; ?></strong>
                                        </div>
                                    <?php
                                    }

                                    ?>
                                    <?php
                                    if (isset($insertMsg)) {
                                    ?>
                                        <div class="alert alert-success">
                                            <strong><?php echo $insertMsg; ?></strong>
                                        </div>
                                    <?php } ?>


                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='firstname' name="firstname">
                                                <label class="form-label" for="firstname" id="firstname" name="firstname">ชื่อ</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='username' name="lastname">
                                                <label class="form-label" for="lastName" id="lastName" name="lastname">นามสกุล</label>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" class="form-control form-control-lg" id='email' name="email" onblur="checkemail(this.value)">
                                        <label class="form-label" for="email" id='email' name="email"> อีเมล</label>
                                        <br /><span id="emailavailable"></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" class="form-control form-control-lg" id='password' name="password">
                                        <label class="form-label" for="form3Example4cg">พาสเวิร์ด</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="date" class="form-control form-control-lg " id='birthday' name="birthday">
                                                <label class="form-label" for="birthday" id="birthday" name="birthday">ระบุวันเกิดของคุณ</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <select class="form-select form-select-lg " type="gender" id='gender' name="gender">
                                                    <option value="ชาย">ชาย</option>
                                                    <option value="หญิง">หญิง</option>
                                                </select>
                                                <label class="form-label" for="gender" id="gender" name="gender">ระบุเพศของคุณ</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='idcard' name="idcard">
                                                <label class="form-label" for="idcard" id="idcard" name="idcard">ระบุรหัสบัตรประชาชน 13 หลัก</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='phone' name="phone">
                                                <label class="form-label" for="phone" id="phone" name="phone">ระบุเบอร์โทรศัพท์ของคุณ</label>
                                            </div>

                                        </div>
                                        <div class="form-outline mb-4">
                                        <label for="name" class="col-sm-5 control-label">อัพโหลดรูปภาพของคุณ</label>
                                              <div class="col-sm-9">
                                                  <input type="file" name="txt_file" class="form-control">
                                              </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit" id="submit" class="btn btn-success ">สมัครสมาชิก</button>
                                    </div>
                                    

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        function checkemail(val) {
            $.ajax({
                type: 'POST',
                url: 'checkemail_available.php',
                data: 'email=' + val,
                success: function(data) {
                    $('#emailavailable').html(data);
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
</body>


</html>