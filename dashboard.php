<?php
require_once('connection.php');
session_start();
if ($_SESSION['id_user'] == "") {
    header("location: signin.php");
} else {
    $id_user = $_SESSION['id_user'];
    $select_stmt = $db->prepare('SELECT * FROM users WHERE id_user = :id');
    $select_stmt->bindParam(":id", $id_user);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include './components/Navbar.php' ?>
    <br />
    <div class="container">

        <div class="alert alert-primary" role="alert">
            โปรไฟล์ของคุณ
        </div>
        <div class="row">
            <div class="col-3">
                <img src="./upload/user/<?php echo $image ?>" class="img-thumbnail" alt="...">
            </div>
            <div class="col">
                <h3>ชื่อ : <?php echo $firstname; ?> <?php echo $lastname; ?></h3>
                <h5>Email : <?php echo $email; ?></h5>
                <h5>เพศ : <?php echo $gender; ?></h5>
                <h5>เบอร์โทรศัทพ์ : <?php echo $phone; ?></h5>
                
            </div>
        </div>
        
         <div class="alert alert-primary" role="alert">
               โปรโมชั่นจากร้านค้าที่คุณติดตาม
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

                    $select_stmt = $db->prepare("SELECT promotionseller.*,shops.nameshop
                        FROM follow
                        INNER JOIN promotionseller
                        ON follow.id_seller = promotionseller.id_seller 
                        INNER JOIN shops
                        ON follow.id_seller = shops.id_seller 
                        WHERE follow.id_user = $id_user
                        AND status = 'yes' ORDER BY regdate DESC limit  $start,$numperpage");
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
                                    echo '<li class="page-item " aria-current="page"><a class="page-link"  href="dashboard.php?promotion=' . $i . '">' . $y . '</a></li>';
                                }
                                ?>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

    </div>
    </div>

    <hr>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>


</html>