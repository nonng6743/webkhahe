<?php
require_once('connection.php');
session_start();

$category_id = $_REQUEST['subcategory_name'];
$select_idcategory = $db->prepare('SELECT * FROM subcategories WHERE namesubcategory  = :id');
$select_idcategory->bindParam(":id", $category_id);
$select_idcategory->execute();
$idcategory = $select_idcategory->fetch(PDO::FETCH_ASSOC);
$subcategorys_id = $idcategory['id_subcategory'];
$namecategory = $idcategory['namesubcategory'];
$categorys_id = $idcategory['id_category'];





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kheha Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php include './components/navbars.php' ?>
    <div class="container">
        <br />
         
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
                <?php echo $namecategory; ?>
                
            </div>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-3">
                            <ul class="list-group">
                                <?php
                                $select_stmt = $db->prepare("SELECT * FROM subcategories WHERE id_category  = '$categorys_id'  ");
                                $select_stmt->execute();

                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) { ?>

                                    <li class="list-group-item">
                                         <div class="text-center">
                                        <a href="productSubcategory.php?subcategory_name=<?php echo $row['namesubcategory']; ?>" class="btn btn-light"> <?php echo $row['namesubcategory']; ?>
                                        </a>
                                        </div></li>
                                <?php } ?>
                                    
                            </ul>
                            <br/>
                        </div>
                         <div class="col-9">
                            <div class="container mt-5">
                                <div class="row">
                                    <?php
                                   
                                    $select_stmt = $db->prepare("SELECT * FROM products WHERE id_subcategory = '$subcategorys_id' ");
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
                         
                    
                    <hr/>
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