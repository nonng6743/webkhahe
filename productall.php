<?php
require_once('./connection.php');
session_start();
error_reporting(0);
$id_user = $_SESSION['id_user'];
if (!$id_user) {
    $id_user = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <title>Kheha K.6</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.css">

    <link rel="stylesheet" href="./assets/css/maicons.css">

    <link rel="stylesheet" href="./assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="./assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="./assets/vendor/fancybox/css/jquery.fancybox.css">

    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a href="index.php" class="navbar-brand">Kheha<span class="text-primary">K.6</span></a>

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto pt-3 pt-lg-0">
                        <li class="nav-item active">
                            <a href="index.php" class="nav-link">หน้าเเรก</a>
                        </li>
                        <li class="nav-item">
                            <a href="./admin/loginAdmin.php" class="nav-link">สำหรับผู้ดูเเลระบบ</a>
                        </li>
                        <li class="nav-item">
                            <a href="./manager/loginManager.php" class="nav-link">สำหรับผู้จัดการตลาด</a>
                        </li>
                        <li class="nav-item">
                            <a href="./seller/signin.php" class="nav-link">สำหรับร้านค้า</a>
                        </li>
                        <li class="nav-item">
                            <a href="reportchat.php" class="nav-link ">เเจ้งปัญหา</a>
                        </li>
                        <li class="nav-item">
                            <a href="signin.php" class="nav-link ">เข้าสู่ระบบ</a>
                        </li>
                        <li class="nav-item">
                            <a href="signup.php" class="nav-link">สมัครสมาชิก</a>
                        </li>
                    </ul>
                </div>
            </div> <!-- .container -->
        </nav> <!-- .navbar -->

        <div class="page-banner home-banner mb-5">
            <div class="slider-wrapper">
                <div class="owl-carousel hero-carousel">
                    <?php
                    $stmt = $db->prepare('select * from promotion');
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                    ?>
                        <div class="hero-carousel-item">
                            <img src="./upload/promotion/<?php echo $row['imgUrl'] ?>" alt="">
                        </div>

                    <?php
                    }
                    ?>

                </div> <!-- .slider-wrapper -->
            </div> <!-- .page-banner -->
        </div>
    </header>

    <main>

        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="title-section">หมวดหมู่สินค้า</h2>
                </div>
                <div class="row justify-content-center">
                    <?php
                    $select_stmt = $db->prepare('SELECT * FROM categories');
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>


                        <div class="col-md-6 col-lg-4 col-xl-3 py-3 mb-3">
                            <div class="text-center">
                                <div class="img-fluid mb-4">
                                    <img src="./upload/categorys/<?php echo $row['image'] ?>" alt="" width="120px" height="120px">
                                    <h5><a href="productCategory.php?category_id=<?php echo $row['namecategory'] ?>"><?php echo $row['namecategory'] ?></a></h5>
                                </div>


                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>

            </div> <!-- .container -->
        </div> <!-- .page-section -->

        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="title-section">สินค้าทั้งหมด</h2>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    $numperpage = 12;
                    $countsql = $db->prepare("SELECT COUNT(id_products) from products");
                    $countsql->execute();
                    $rowe = $countsql->fetch();
                    $numrecords = $rowe[0];

                    $numlinke = ceil($numrecords / $numperpage);
                    $page = $_GET['products'];
                    if (!$page) $page = 0;
                    $start = $page * $numperpage;

                    $select_stmt = $db->prepare("SELECT * FROM products ORDER BY regdate DESC limit  $start,$numperpage");
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

                        $product_id = $row['id_products'];
                        $select_view = $db->prepare('SELECT COUNT(id_products) AS view FROM actionclickuser WHERE id_products= :id');
                        $select_view->bindParam(":id", $product_id);
                        $select_view->execute();
                        $view = $select_view->fetch(PDO::FETCH_ASSOC);

                    ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="text-center">
                                    <br />
                                    <img src="./upload/product/<?php echo $row['image']; ?>" width="200px" height="200px">
                                </div>
                                <div class="text-center">
                                    <br />
                                    <h4><?php $name = $row['nameproduct'];
                                        echo  mb_substr("$name", 0, 20, "UTF-8") . "..."; ?></h4>
                                    <h6><?php
                                        $description = $row['detail'];
                                        echo  mb_substr("$description", 0, 20, "UTF-8") . "..."; ?></h6>
                                    <span class="text-success">
                                        <h5>ราคา <?php $price =  $row['price'];
                                                    $prices = intval($price);
                                                    echo number_format($prices, 2); ?> บาท</h5>
                                    </span>
                                    <h6>มีผู้เข้าชมเเล้ว: <?php echo $view['view']; ?> </h6>

                                    <a href="product.php?product_id=<?php echo $row['id_products']; ?>" class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>
                                </div>
                                <br />
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <br />
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <nav aria-label>
                            <ul class="pagination pagination-lg">

                                <?php
                                for ($i = 0; $i <= $numlinke; $i++) {
                                    $y = $i + 1;
                                    echo '<li class="page-item " aria-current="page"><a class="page-link"  href="productall.php?products=' . $i . '">' . $y . '</a></li>';
                                }
                                ?>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>


    </main>




    <script src=" ./assets/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <script src="./assets/vendor/wow/wow.min.js"></script>

    <script src="./assets/vendor/fancybox/js/jquery.fancybox.min.js"></script>

    <script src="./assets/vendor/isotope/isotope.pkgd.min.js"></script>

    <script src="./assets/js/google-maps.js"></script>

    <script src="./assets/js/theme.js"></script>

    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap"></script> -->

</body>

</html>