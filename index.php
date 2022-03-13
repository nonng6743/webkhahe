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
                    $page = $_GET['start'];
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
                <div class="text-center">
                    <a href="productall.php" class="btn btn-primary">เเสดงเพิ่มเติม</a>
                </div>

            </div>
        </div>
        










        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <div class="subhead">Our Teams</div>
                    <h2 class="title-section">The Expert Team on ReveTive</h2>
                </div>

                <div class="owl-carousel team-carousel mt-5">
                    <div class="team-wrap">
                        <div class="team-profile">
                            <img src="../assets/img/teams/team_1.jpg" alt="">
                        </div>
                        <div class="team-content">
                            <h5>Walter White</h5>
                            <div class="text-sm fg-grey">Chief Executive Officer</div>

                            <div class="social-button">
                                <a href="#"><span class="mai-logo-facebook-messenger"></span></a>
                                <a href="#"><span class="mai-call"></span></a>
                                <a href="#"><span class="mai-mail"></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="team-wrap">
                        <div class="team-profile">
                            <img src="../assets/img/teams/team_2.jpg" alt="">
                        </div>
                        <div class="team-content">
                            <h5>Sarah Johanson</h5>
                            <div class="text-sm fg-grey">Chief Technology Officer</div>

                            <div class="social-button">
                                <a href="#"><span class="mai-logo-facebook-messenger"></span></a>
                                <a href="#"><span class="mai-call"></span></a>
                                <a href="#"><span class="mai-mail"></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="team-wrap">
                        <div class="team-profile">
                            <img src="../assets/img/teams/team_3.jpg" alt="">
                        </div>
                        <div class="team-content">
                            <h5>Anna Anderson</h5>
                            <div class="text-sm fg-grey">Product Manager</div>

                            <div class="social-button">
                                <a href="#"><span class="mai-logo-facebook-messenger"></span></a>
                                <a href="#"><span class="mai-call"></span></a>
                                <a href="#"><span class="mai-mail"></span></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- .container -->
        </div> <!-- .page-section -->

        <div class="page-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 py-3">
                        <div class="subhead">Portfolio</div>
                        <h2 class="title-section">Our Latest Projects</h2>
                    </div>
                    <div class="col-md-6 py-3 text-md-right">
                        <a href="portfolio.html" class="btn btn-outline-primary">Browse Projects <span class="mai-arrow-forward ml-2"></span></a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-4 py-3">
                        <div class="portfolio">
                            <a href="../assets/img/portfolio/work-1.jpg" data-fancybox="portfolio">
                                <img src="../assets/img/portfolio/work-1.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 py-3">
                        <div class="portfolio">
                            <a href="../assets/img/portfolio/work-2.jpg" data-fancybox="portfolio">
                                <img src="../assets/img/portfolio/work-2.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 py-3">
                        <div class="portfolio">
                            <a href="../assets/img/portfolio/work-3.jpg" data-fancybox="portfolio">
                                <img src="../assets/img/portfolio/work-3.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 py-3">
                        <div class="portfolio">
                            <a href="../assets/img/portfolio/work-4.jpg" data-fancybox="portfolio">
                                <img src="../assets/img/portfolio/work-4.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 py-3">
                        <div class="portfolio">
                            <a href="../assets/img/portfolio/work-5.jpg" data-fancybox="portfolio">
                                <img src="../assets/img/portfolio/work-5.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 py-3">
                        <div class="portfolio">
                            <a href="../assets/img/portfolio/work-6.jpg" data-fancybox="portfolio">
                                <img src="../assets/img/portfolio/work-6.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .page-section -->

        <!-- Testimonials -->
        <div class="page-section">
            <div class="container">
                <div class="owl-carousel testimonial-carousel">
                    <div class="card-testimonial">
                        <div class="content">
                            The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph
                        </div>
                        <div class="author">
                            <div class="avatar">
                                <img src="../assets/img/person/person_1.jpg" alt="">
                            </div>
                            <div class="d-inline-block ml-2">
                                <div class="author-name">Sam Watson</div>
                                <div class="author-info">CEO - Mosh Elite Ltd.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-testimonial">
                        <div class="content">
                            The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph
                        </div>
                        <div class="author">
                            <div class="avatar">
                                <img src="../assets/img/person/person_2.jpg" alt="">
                            </div>
                            <div class="d-inline-block ml-2">
                                <div class="author-name">Edinson Alfa</div>
                                <div class="author-info">CEO - Mosh Elite Ltd.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-testimonial">
                        <div class="content">
                            The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph
                        </div>
                        <div class="author">
                            <div class="avatar">
                                <img src="../assets/img/person/person_3.jpg" alt="">
                            </div>
                            <div class="d-inline-block ml-2">
                                <div class="author-name">May Halloway</div>
                                <div class="author-info">CEO - Mosh Elite Ltd.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-testimonial">
                        <div class="content">
                            The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph
                        </div>
                        <div class="author">
                            <div class="avatar">
                                <img src="../assets/img/person/person_1.jpg" alt="">
                            </div>
                            <div class="d-inline-block ml-2">
                                <div class="author-name">Sam Watson</div>
                                <div class="author-info">CEO - Mosh Elite Ltd.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-testimonial">
                        <div class="content">
                            The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph
                        </div>
                        <div class="author">
                            <div class="avatar">
                                <img src="../assets/img/person/person_2.jpg" alt="">
                            </div>
                            <div class="d-inline-block ml-2">
                                <div class="author-name">Edinson Alfa</div>
                                <div class="author-info">CEO - Mosh Elite Ltd.</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-testimonial">
                        <div class="content">
                            The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph
                        </div>
                        <div class="author">
                            <div class="avatar">
                                <img src="../assets/img/person/person_3.jpg" alt="">
                            </div>
                            <div class="d-inline-block ml-2">
                                <div class="author-name">May Halloway</div>
                                <div class="author-info">CEO - Mosh Elite Ltd.</div>
                            </div>
                        </div>
                    </div>

                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .page-section -->

        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <div class="subhead">News</div>
                    <h2 class="title-section">Read Our Latest News</h2>
                </div>

                <div class="row my-5 card-blog-row">
                    <div class="col-lg-3 py-3">
                        <div class="card-blog">
                            <div class="header">
                                <div class="entry-footer">
                                    <div class="post-author">Sam Newman</div>
                                    <a href="#" class="post-date">23 Apr 2020</a>
                                </div>
                            </div>
                            <div class="body">
                                <div class="post-title"><a href="blog-single.html">What is Business Management?</a></div>
                            </div>
                            <div class="footer">
                                <a href="blog-single.html">Read More <span class="mai-chevron-forward text-sm"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 py-3">
                        <div class="card-blog">
                            <div class="header">
                                <div class="avatar">
                                    <img src="../assets/img/person/person_1.jpg" alt="">
                                </div>
                                <div class="entry-footer">
                                    <div class="post-author">Sam Newman</div>
                                    <a href="#" class="post-date">23 Apr 2020</a>
                                </div>
                            </div>
                            <div class="body">
                                <div class="post-title"><a href="blog-single.html">What is Business Management?</a></div>
                                <div class="post-excerpt">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                            </div>
                            <div class="footer">
                                <a href="blog-single.html">Read More <span class="mai-chevron-forward text-sm"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 py-3">
                        <div class="card-blog">
                            <div class="header">
                                <div class="avatar">
                                    <img src="../assets/img/person/person_2.jpg" alt="">
                                </div>
                                <div class="entry-footer">
                                    <div class="post-author">Sam Newman</div>
                                    <a href="#" class="post-date">23 Apr 2020</a>
                                </div>
                            </div>
                            <div class="body">
                                <div class="post-title"><a href="blog-single.html">What is Business Management?</a></div>
                                <div class="post-excerpt">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                            </div>
                            <div class="footer">
                                <a href="blog-single.html">Read More <span class="mai-chevron-forward text-sm"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 py-3">
                        <div class="card-blog">
                            <div class="header">
                                <div class="avatar">
                                    <img src="../assets/img/person/person_3.jpg" alt="">
                                </div>
                                <div class="entry-footer">
                                    <div class="post-author">Sam Newman</div>
                                    <a href="#" class="post-date">23 Apr 2020</a>
                                </div>
                            </div>
                            <div class="body">
                                <div class="post-title"><a href="blog-single.html">What is Business Management?</a></div>
                                <div class="post-excerpt">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</div>
                            </div>
                            <div class="footer">
                                <a href="blog-single.html">Read More <span class="mai-chevron-forward text-sm"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="blog.html" class="btn btn-primary">View More</a>
                </div>

            </div> <!-- .container -->
        </div> <!-- .page-section -->

        <div class="page-section">
            <div class="container">
                <div class="text-center">
                    <h2 class="title-section mb-3">Stay in touch</h2>
                    <p>Just say hello or drop us a line. You can manualy send us email on <a href="mailto:example@mail.com">example@mail.com</a></p>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-8">
                        <form action="#" class="form-contact">
                            <div class="row">
                                <div class="col-sm-6 py-2">
                                    <label for="name" class="fg-grey">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name..">
                                </div>
                                <div class="col-sm-6 py-2">
                                    <label for="email" class="fg-grey">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Email address..">
                                </div>
                                <div class="col-12 py-2">
                                    <label for="subject" class="fg-grey">Subject</label>
                                    <input type="text" class="form-control" id="subject" placeholder="Subject..">
                                </div>
                                <div class="col-12 py-2">
                                    <label for="message" class="fg-grey">Message</label>
                                    <textarea id="message" rows="8" class="form-control" placeholder="Enter message.."></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary px-5">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- .container -->
        </div> <!-- .page-section -->

        <div class="page-section">
            <div class="container-fluid">
                <div class="row row-cols-md-3 row-cols-lg-5 justify-content-center text-center">
                    <div class="py-3 px-5">
                        <img src="../assets/img/clients/airbnb.png" alt="">
                    </div>
                    <div class="py-3 px-5">
                        <img src="../assets/img/clients/google.png" alt="">
                    </div>
                    <div class="py-3 px-5">
                        <img src="../assets/img/clients/mailchimp.png" alt="">
                    </div>
                    <div class="py-3 px-5">
                        <img src="../assets/img/clients/paypal.png" alt="">
                    </div>
                    <div class="py-3 px-5">
                        <img src="../assets/img/clients/stripe.png" alt="">
                    </div>
                </div>
            </div> <!-- .container-fluid -->
        </div> <!-- .page-section -->

    </main>

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 py-3">
                    <h3>Reve<span class="fg-primary">Tive.</span></h3>
                </div>
                <div class="col-lg-3 py-3">
                    <h5>Contact Information</h5>
                    <p>301 The Greenhouse, Custard Factory, London, E2 8DY.</p>
                    <p>Email: example@mail.com</p>
                    <p>Phone: +00 112323980</p>
                </div>
                <div class="col-lg-3 py-3">
                    <h5>Company</h5>
                    <ul class="footer-menu">
                        <li><a href="#">Career</a></li>
                        <li><a href="#">Resources</a></li>
                        <li><a href="#">News & Feed</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 py-3">
                    <h5>Newsletter</h5>
                    <form action="#">
                        <input type="text" class="form-control" placeholder="Enter your email">
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Submit</button>
                    </form>
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col-md-6">
                    <p>Copyright 2020. This template designed by <a href="https://macodeid.com">MACode ID</a></p>
                </div>
                <div class="col-md-6 text-right">
                    <div class="sosmed-button">
                        <a href="#"><span class="mai-logo-facebook-f"></span></a>
                        <a href="#"><span class="mai-logo-twitter"></span></a>s/jquery-3.5.1.min.js"></script>

                        <a href="#"><span class="mai-logo-youtube"></span></a>
                        <a href="#"><span class="mai-logo-linkedin"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="./assets/j
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