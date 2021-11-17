<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./seller/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./seller/dist/css/adminlte.min.css">
</head>

<body>
    <div class="alert alert-primary" role="alert">
        <div class="container">
            <div class="row">
                <div class="col-10">สินค้าจากร้านเดียวกัน</div>
                <div class="col-2"><a href="shopproduct.php?product_id=<?php echo $row['id_shop']; ?>" >สินค้าทั้งหมด</a></div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php
            $id_product = $row['id_products'];
            $numperpage = 4;
            $countsql = $db->prepare("SELECT COUNT(id_products) from products");
            $countsql->execute();
            $rowe = $countsql->fetch();
            $numrecords = $rowe[0];

            $numlinke = ceil($numrecords / $numperpage);
            $page = $_GET['start'];
            if (!$page) $page = 0;
            $start = $page * $numperpage;

            $select_stmt = $db->prepare("SELECT * FROM products WHERE id_shop ='$id_shop' limit $start,$numperpage ");
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
                            <img src="./upload/<?php echo $row['imgUrl']; ?>" width="200px" height="200px">
                        </div>
                        <div class="text-center">
                            <br />
                            <h4><?php echo $row['name']; ?></h4>
                            <span class="text-success">
                                <h5>ราคา <?php echo $row['price']; ?> บาท</h5>
                            </span>
                            <h6>View: <?php echo $view['view']; ?> </h6>
                            <h6>วันที่โพสต์: <?php echo $row['regdate']; ?></h6>
                            <a href="product.php?product_id=<?php echo $row['id_products']; ?>" class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a>

                        </div>
                        <br />
                    </div>
                </div>
            <?php } ?>

        </div>
        <br />

    </div>
    
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