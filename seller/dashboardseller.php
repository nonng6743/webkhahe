<?php
require_once('../connection.php');
session_start();
include_once('../functions.php');
$userdata = new DB_con();

$id_seller = $_SESSION['id_seller'];
$firstname =  $_SESSION['firstname'];

$sqlidseller = $userdata->quertyidseller($id_seller);
$num = mysqli_num_rows($sqlidseller);

if ($_SESSION['id_seller'] == "") {
    header("location: signin.php");
}
if ($_SESSION['role'] == "noseller") {
    echo "<script>alert('รอการอนุมัติจากผู้จัดการ')</script>";
    echo "<script>window.location.href='../seller/signin.php'</script>";
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>

    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">

            <?php include './components/MainSidebarContainer.php' ?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Dashboard </h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active">Dashboard </li>
                                </ol>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                        <?php 
                            if($num > 0){?>
                        
                        <h5 class="mb-2 mt-4">รายงาน</h5>
                        <br />
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <br />
                                    <div class="inner">
                                        <?php

                                        $id_seller = $_SESSION['id_seller'];
                                        $select_shop = $db->prepare('SELECT * FROM shops WHERE id_seller = :id');
                                        $select_shop->bindParam(":id", $id_seller);
                                        $select_shop->execute();
                                        $rowshop = $select_shop->fetch(PDO::FETCH_ASSOC);
                                        extract($rowshop);


                                        $sql = "SELECT COUNT(*) FROM products WHERE id_shop = '$id_shop'";
                                        $res = $db->query($sql);
                                        $count_product = $res->fetchColumn();
                                        ?>

                                        <h3><?php echo $count_product ?></h3>

                                        <p>จำนวนสินค้าของคุณ</p>
                                        <br />

                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-10">
                                <h5 class="mb-2 mt-4">รายงานยอดผู้เข้าชมสินค้า</h5>
                                <br />
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">ยอดผู้เข้าชมสินค้า</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>ยอดผู้เข้าชมสินค้า</th>
                                                    <th>รูปภาพสินค้า</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_stmt = $db->prepare("SELECT * FROM products WHERE id_shop = $id_shop");
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $product_id = $row['id_products'];
                                                    $select_view = $db->prepare('SELECT COUNT(id_products) AS view FROM actionclickuser WHERE id_products= :id');
                                                    $select_view->bindParam(":id", $product_id);
                                                    $select_view->execute();
                                                    $view = $select_view->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['nameproduct']; ?></td>
                                                        <td><?php echo $view['view']; ?></td>
                                                        <td><img src="../upload/product/<?php echo $row['image']; ?>" width="50px" height="50px" alt=""></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.row -->
                            
                           
                            <?php }else{} ?>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
    </body>

    </html>


<?php
}
?>