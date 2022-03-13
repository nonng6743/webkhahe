<?php
require_once('connection.php');
session_start();
error_reporting(0);
$id_user = $_SESSION['id_user'] || "0";

if (isset($_REQUEST['shop_id'])) {
    try {
        $id_shop = $_REQUEST['shop_id'];
        $select_stmt = $db->prepare('SELECT * FROM shops WHERE id_shop = :id');
        $select_stmt->bindParam(":id", $id_shop);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);



        $select_seller = $db->prepare('SELECT * FROM sellers WHERE id_seller = :id');
        $select_seller->bindParam(":id", $row['id_seller']);
        $select_seller->execute();
        $rowseller = $select_seller->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Products</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./seller/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./seller/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <?php include './components/navbars.php' ?>
    <div class="wrapper">
        <!-- Main content -->
        <div class="container-md">
            <section class="content-header">
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="col-12">
                                    <br />
                                    <img src="./upload/shop/<?php echo $row['image']; ?>" class="product-image">
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">ร้านค้า : <?php echo $row['nameshop']; ?></h3>
                                <h5 class="my-3">รายละเอียดร้านค้า</h5>
                                <p><?php echo $description; ?></p>
                                <hr>


                                <h5 class="my-3">ช่องทางการติดต่อ : <label> <?php echo $rowseller['phone']; ?></label></h5>
                                <h5 class="my-3">ผู้ขาย : <label> <?php echo $rowseller['firstname']; ?> <?php echo $rowseller['lastname']; ?></label></h5>
                                
                                <h5 class="my-3">ตำเเหน่งร้านค้า </h5>

                                <?php
                                $lat = $row['lat'];
                                $lng = $row['lng'];
                                echo '<script type="text/javascript">';
                                echo "var lat = '$lat';"; 
                                echo "var lng = '$lng';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
                                echo '</script>';

                                ?>
                                <div id="map"></div>

                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />

                        <hr />
                        <div class="alert alert-primary" role="alert">
               โปรโมชั่นจาากร้านค้า
            </div>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    $numperpage = 3;
                    $countsql = $db->prepare("SELECT COUNT(id_promotionseller) from promotionseller");
                    $countsql->execute();
                    $rowe = $countsql->fetch();
                    $numrecords = $rowe[0];

                    $numlinke = ceil($numrecords / $numperpage);
                    $page = $_GET['promotion'];
                    if (!$page) $page = 0;
                    $start = $page * $numperpage;
                    
                    $seller_id = $rowseller['id_seller'];
                    $select_stmt = $db->prepare("SELECT * FROM promotionseller WHERE status = 'yes' AND id_seller = 
                    '$seller_id' ORDER BY regdate DESC limit  $start,$numperpage");
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

                        

                    ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="text-center">
                                    <br />
                                     <img src="./upload/promotionseller/<?php echo $row['image']; ?>" width="200px" height="200px" class="card-img-top" alt="...">
                                </div>
                                <div class="text-center">
                                    <br />
                                     <p class="card-text"><?php echo $row['detailpromotion'] ?></p>
                                     <?php 
                                    $id_seller = $row['id_seller'];
                                    $select_shop = $db->prepare("SELECT * FROM shops WHERE id_seller = '$id_seller'");
                                    $select_shop->execute();
                                    $rowshop = $select_shop->fetch(PDO::FETCH_ASSOC);
                                    
                                    
                                    ?>
                                     <p>โปรโมชั่นจากร้านค้า :
                                     <a href="shopproduct.php?shop_id=<?php echo $rowshop['id_shop']; ?>" ><?php echo $rowshop['nameshop']; ?></a>
                                    </p>
                                </div>
                                <br />
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <br/>
                         <div class="alert alert-primary" role="alert">
                        สินค้าทั้งหมดจากร้าน
                    </div>
                    <div class="container mt-5">
                        <div class="row">
                            <?php
                            

                            $select_stmt = $db->prepare("SELECT * FROM products WHERE id_shop = '$id_shop' ");
                            $select_stmt->execute();

                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

                                $product_id = $row['id_products'];
                                $select_view = $db->prepare('SELECT COUNT(id_products) AS view FROM actionclickuser WHERE id_products= :id');
                                $select_view->bindParam(":id", $product_id);
                                $select_view->execute();
                                $view = $select_view->fetch(PDO::FETCH_ASSOC);

                            ?>
                                <div class="col-md-4">
                            <div class="card">
                                <div class="text-center">
                                    <br />
                                    <img src="./upload/product/<?php echo $row['image']; ?>" width="200px" height="200px">
                                </div>
                                <div class="text-center">
                                    <br />
                                    <h4><?php echo $row['nameproduct']; ?></h4>
                                    <h6><?php
                                        $description = $row['detail'];
                                        echo  mb_substr("$description",0,20,"UTF-8")."...";?></h6>
                                    <span class="text-success">
                                        <h5>ราคา  <?php $price =  $row['price'];
                                                    $prices = intval($price);
                                                    echo number_format($prices,2); ?> บาท</h5>
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
                </div>
            </section>
        </div>
    </div>

    </div>
    <script type="text/javascript">
        var map;

        var position = {
            lat: (parseFloat(lat)),
            lng: (parseFloat(lng))
        };

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: position,
                zoom: 18
            });
            var marker = new google.maps.Marker({
                position:position,
                map:map,
            });


        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATSEBp-3BMGJh4j5Cpdk1XrP1Q_kcoOkk&callback=initMap&libraries=&v=weekly" async></script>
    <!-- jQuery -->
    <script src="./seller/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./seller/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./seller/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./seller/dist/js/demo.js"></script>

</body>

</html>