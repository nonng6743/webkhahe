<?php
require_once('connection.php');

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
                    <img src="./upload/img/thumb-1920-633288.png" class="d-block w-100">
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
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <hr />
        <div class="alert alert-primary" role="alert">
            หมวดหมูสินค้า
        </div>
        <div class="container">
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=อาหารสด"><img src="./upload/img/ARTICLE.jpg" width="40px" height="40px"></a> อาหารสด</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=อาหารสำเร็จรูป"><img src="./upload/img/อาหารสำเร็จรูป.jpg" width="40px" height="40px"></a> อาหารสำเร็จรูป</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=อาหารหวาน"><img src="./upload/img/อาหารหวาน.jpg" width="40px" height="40px"></a> อาหารหวาน</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=เครื่องดื่ม"><img src="./upload/img/เครื่องดื่ม.jpg" width="40px" height="40px"></a> เครื่องดื่ม</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=สินค้าจิปาถะ"><img src="./upload/img/สินค้าจิปาถะ.jpg" width="40px" height="40px"></a> สินค้าจิปาถะ</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=เครื่องแต่งกาย"><img src="./upload/img/เสื้อผ้า.jpg" width="40px" height="40px"></a> เครื่องแต่งกาย</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=สินค้ามือสอง"><img src="./upload/img/สินค้ามือสอง.jpg" width="40px" height="40px"></a> สินค้ามือสอง</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=ผลไม้"><img src="./upload/img/ผลไม้.jpg" width="40px" height="40px"></a> ผลไม้</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=ผัก"><img src="./upload/img/ผัก.jpg" width="40px" height="40px"></a> ผัก</div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light"><a href="productCategory.php?category_id=อาหารแห้ง"><img src="./upload/img/อาหารแห้ง.jpg" width="40px" height="40px"></a> อาหารแห้ง</div>
                </div>
            </div>
            <hr />


            <div class="alert alert-primary" role="alert">
                สินค้าเเนะนำ
            </div>
            <?php include './components/page/products/products.php' ?>




        </div>



    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>


</html>