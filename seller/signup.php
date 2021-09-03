<?php
include_once('../functions.php');
$userdata = new DB_con();

if (isset($_POST['submit'])) {
    $fastname = $_POST['fastname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $idcard = $_POST['idcard'];
    $phone = $_POST['phone'];

    $sql = $userdata->registrationseller($fastname, $lastname, $idcard,$email, $password, $gender, $phone ,$birthday);
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">สมัครสมาชิก</h1>
        <hr>
        <form method="POST">
            <div class="mb-3">
                <label for="fastname" class="form-label">ชื่อจริง</label>
                <input type="text" class="form-control" id='username' name="fastname">

            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id='username' name="lastname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id='email' name="email" onblur="checkemail(this.value)">
              
                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="password" class="form-control" id='password' name="password">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">เพศ</label>
                    <input type="text" class="form-control" id='gender' name="gender">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">วันเกิด</label>
                    <input type="date" class="form-control" id='birthday' name="birthday">
                </div>
                <div class="mb-3">
                    <label for="idcard" class="form-label">เลขบัตรประชาชน</label>
                    <input type="text" class="form-control" id='idcard' name="idcard">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">เบอร์</label>
                    <input type="text" class="form-control" id='phone' name="phone">
                </div>
                <button type="submit" name="submit" class="btn btn-success">สมัครสมาชิก</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>