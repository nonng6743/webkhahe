<?php
require_once('connection.php');
session_start();
error_reporting(0);
$id_user = $_SESSION['id_user'] || "0";
$seach_name = $_REQUEST['seach_name'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>search product</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./seller/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./seller/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    

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
                  
                    <div class="alert alert-primary" role="alert">
                        สินค้าที่ค้นหา
                    </div>
                    <div class="container mt-5">
                        <div class="row">
                            <?php
                            

                            $select_stmt = $db->prepare("SELECT * FROM products WHERE nameproduct LIKE '%$seach_name%' ");
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
                    <br />
                   
                    


                </div>
            </section>
        </div>
    </div>

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