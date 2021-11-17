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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ตลาดเคหะคลองหก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php include './components/navbar.php' ?>
    <div class="container">
        <br />

        <div class="alert alert-primary" role="alert">
            โปรโมชั่นสินค้า
        </div>
           
       
            
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./upload/promotion/home.jpg" class="d-block w-100">
                </div>
                <?php
                $stmt = $db->prepare('select * from promotion');
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                ?>
                    <div class="carousel-item ">
                        <img src="./upload/promotion/<?php echo $row['imgUrl'] ?>" class="d-block w-100">
                    </div>

                <?php
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">ก่อนหน้า</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">ถัดไป</span>
            </button>
        </div>

        <hr />
        <div class="alert alert-primary" role="alert">
            หมวดหมู่สินค้า
        </div>
       <div class="container">
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                <?php
                $select_stmt = $db->prepare('SELECT * FROM categories');
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="col">
                        <div class="p-3 border bg-light"><a href="productCategory.php?category_id=<?php echo $row['namecategory'] ?>"><img src="./upload/categories/<?php echo $row['image'] ?>" width="40px" height="40px"></a> <?php echo $row['namecategory'] ?></div>
                    </div>
                <?php } ?>
            </div>
            <hr />
             <div class="alert alert-primary" role="alert">
               โปรโมชั่นจากร้านค้า
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

                    $select_stmt = $db->prepare("SELECT * FROM promotionseller WHERE status = 'yes' ORDER BY regdate DESC limit  $start,$numperpage");
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
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <nav aria-label>
                        <ul class="pagination pagination-lg">

                                <?php
                                for ($i = 0; $i <= $numlinke; $i++) {
                                    $y = $i + 1;
                                    echo '<li class="page-item " aria-current="page"><a class="page-link"  href="index.php?promotion=' . $i . '">' . $y . '</a></li>';
                                }
                                ?>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        
              <hr />
            
            


            <div class="alert alert-primary" role="alert">
                สินค้าเเนะนำ
            </div>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    $select_stmts = $db->prepare("SELECT * FROM products ");
                    $select_stmts->execute();
                    $viewarray = array();
                    $id_productarray = array();
                    while ($row = $select_stmts->fetch(PDO::FETCH_ASSOC)) {
                        $id_user = $_SESSION['id_user'];
                        if (!$id_user) {
                            $id_user = 0;
                        }

                        $product_id = $row['id_products'];
                        $select_view = $db->prepare('SELECT COUNT(id_products) AS view FROM actionclickuser WHERE id_products= :id AND id_user = :idu');
                        $select_view->bindParam(":id", $product_id);
                        $select_view->bindParam(":idu", $id_user);
                        $select_view->execute();
                        $view = $select_view->fetch(PDO::FETCH_ASSOC);
                        $id_productarray[] = $row['id_products'];
                        $viewarray[] = $view['view'];
                    }
                    $maxview = max($viewarray);
                    $key = array_search($maxview, $viewarray);
                    $keys = $id_productarray[$key];
                    $select_stmts = $db->prepare("SELECT * FROM products WHERE id_products = :ukey");
                    $select_stmts->bindParam(":ukey", $keys);
                    $select_stmts->execute();
                    $rowss = $select_stmts->fetch(PDO::FETCH_ASSOC);
                    extract($rowss);
                     
                    $numperpage = 6;
                    $countsql = $db->prepare("SELECT COUNT(id_products) from products");
                    $countsql->execute();
                    $rowe = $countsql->fetch();
                    $numrecords = $rowe[0];

                    $numlinke = ceil($numrecords / $numperpage);
                    $page = $_GET['start'];
                    if (!$page) $page = 0;
                   

                    $select_stmt = $db->prepare("SELECT * FROM products WHERE id_subcategory = '$id_subcategory' limit $numperpage");
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
                                    <h4><?php $name = $row['nameproduct'];
                                        echo  mb_substr("$name",0,20,"UTF-8")."..."; ?></h4>
                                    <h6><?php
                                        $description = $row['detail'];
                                        echo  mb_substr("$description",0,20,"UTF-8")."...";?></h5>
                                    <span class="text-success">
                                        <h5>ราคา  <?php $price =  $row['price'];
                                                    $prices = intval($price);
                                                    echo number_format($prices,2); ?> บาท</h6>
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
            <div class="alert alert-primary" role="alert">
               สินค้าทั้งหมด
            </div>
            <div class="container mt-5">
                <div class="row">
                    <?php
                    $numperpage = 20;
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
                                        echo  mb_substr("$name",0,20,"UTF-8")."..."; ?></h4>
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
            <br/>
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <nav aria-label>
                        <ul class="pagination pagination-lg">

                                <?php
                                for ($i = 0; $i <= $numlinke; $i++) {
                                    $y = $i + 1;
                                    echo '<li class="page-item " aria-current="page"><a class="page-link"  href="index.php?start=' . $i . '">' . $y . '</a></li>';
                                }
                                ?>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>



    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>


</html>