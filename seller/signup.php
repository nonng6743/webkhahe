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
    $role="noseller";

    $sql = $userdata->registrationseller($fastname, $lastname, $idcard, $email, $password, $gender, $phone, $birthday,$role);
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
    <title>Signup Seller</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <?php include './components/navbars.php' ?>
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">account seller</h2>

                                <form method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='username' name="fastname">
                                                <label class="form-label" for="firstName" id="firstName" name="fastname">First Name</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='username' name="lastname">
                                                <label class="form-label" for="lastName" id="lastName" name="lastname">Last Name</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" class="form-control form-control-lg" id='email' name="email">
                                        <label class="form-label" for="email" id='email' name="email">Your Email</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" class="form-control form-control-lg" id='password' name="password">
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="date" class="form-control form-control-lg " id='birthday' name="birthday">
                                                <label class="form-label" for="birthday" id="birthday" name="birthday">birthday</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <select class="form-select form-select-lg " type="gender" id='gender' name="gender">
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                                <label class="form-label" for="gender" id="gender" name="gender">gender</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='idcard' name="idcard">
                                                <label class="form-label" for="idcard" id="idcard" name="idcard">IDcard for 13 number</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" class="form-control form-control-lg" id='phone' name="phone">
                                                <label class="form-label" for="phone" id="phone" name="phone">Phone Number</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register for Seller</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!" class="fw-bold text-body"><u>Login here</u></a></p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

</html>