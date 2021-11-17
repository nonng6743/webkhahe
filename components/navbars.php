<?php
error_reporting(0);
session_start();
$id_user = $_SESSION['id_user'];
$firstname = $_SESSION['firstname'];
$img = $_SESSION['image'];

if (isset($_POST['submit'])) {
    $name = $_POST['namesearch'];
    echo "<script>window.location.href='./seachproduct.php?seach_name=$name'</script>";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../projectweb/">
                <h3 class="logo">Kheha K.6</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../projectweb">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../projectweb/admin/loginAdmin.php">สำหรับ Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../projectweb/manager/loginManager.php">สำหรับ Manager</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../projectweb/seller/signin.php">Seller Centre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../projectweb/seller/signup.php">ขายสินค้ากับเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./reportchat.php">เเจ้งปัญหากับเรา</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        if (!$id_user) {
                            echo "<li><a class='nav-link' href='./signin.php'>เข้าสู่ระบบ</a></li>";
                            echo "<li><a class='nav-link' href='./signup.php'>สมัครสมาชิก</a></li>";
                        } elseif ($id_user) {
                            echo "<li><a class='nav-link' href='./dashboard.php'><img src='./upload/profile/$img' width='20px' height='20px' alt=''>$firstname</a></li>";
                            echo "<li><a href='logout.php' class='btn btn-danger'>Logout</a></li>";
                        }
                        ?>
                    </ul>
                </form>


            </div>
        </div>
    </nav>
    <br />
    <div class="wrapper">
        <div class="container-md">
            <section class="content">
                <div class="card card-solid">
                    <div class="alert alert-primary" role="alert">
                        <form class="d-flex" action="" method="post" enctype="multipart/form-data">
                            <input class="form-control me-2" type="search" placeholder="Search" name="namesearch" aria-label="Search">
                            <button class="btn btn-primary" type="submit" name="submit">ค้นหา</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>


</body>

</html>