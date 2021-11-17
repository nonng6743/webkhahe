<?php
require_once('connection.php');
session_start();
error_reporting(0);
$id_user = $_SESSION['id_user'] ;
if(!$id_user){
    $id_user = 0;
}

if (isset($_REQUEST['product_id'])) {
    try {
        $id_products = $_REQUEST['product_id'];
        $select_stmt = $db->prepare('SELECT * FROM products WHERE id_products = :id');
        $select_stmt->bindParam(":id", $id_products);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        
        $select_shop = $db->prepare('SELECT * FROM shops WHERE id_shop = :id');
        $select_shop->bindParam(":id", $id_shop);
        $select_shop->execute();
        $rowshop = $select_shop->fetch(PDO::FETCH_ASSOC);
        extract($rowshop);
        

        $select_seller = $db->prepare('SELECT * FROM sellers WHERE id_seller = :id');
        $select_seller->bindParam(":id", $id_seller);
        $select_seller->execute();
        $rowseller = $select_seller->fetch(PDO::FETCH_ASSOC);
       
        
        

        $sql = ("INSERT INTO actionclickuser(id_user , id_products) VALUES ('$id_user','$id_products')");
        $stmt = $db->prepare($sql);
        $stmt->execute();


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
    <title>product</title>

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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="col-12">
                                    <br />
                                    <img src="./upload/product/<?php echo $row['image'];?>" class="product-image">
                       
                                </div>
                                
                       
                                
                                

                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3"><?php echo $nameproduct ?></h3>
                                <h5 class="my-3">รายละเอียดสินค้า</h5>
                                <p><?php echo $detail; ?></p>
                                <hr>
                                 <h5 class="my-3">ประเภทของสินค้า : <label>
                                <?php 
                                 
                                 $select_namecategory = $db->prepare('SELECT namesubcategory  FROM subcategories WHERE id_subcategory = :id ');
                                 $select_namecategory->bindParam(":id", $id_subcategory);
                                 $select_namecategory->execute();
                                 $namecategory = $select_namecategory->fetch(PDO::FETCH_ASSOC);
                                 echo $namecategory['namesubcategory'];
                                
                                ?></label></h5>
                                <h5 class="my-3">ร้านค้า : <label><?php echo $nameshop; ?></label></h5>   <div class="col-md-auto">
                            <a href="shopproduct.php?shop_id=<?php echo $id_shop; ?>" class="btn btn-primary">ดูข้อมูลร้านค้า</a>
                            </div>
                                <h5 class="my-3">ช่องทางการติดต่อ : <label> <?php echo $rowseller['phone']; ?></label></h5>
                                <h5 class="my-3">ผู้ขาย : <label> <?php echo $rowseller['firstname']; ?>  <?php echo $rowseller['lastname']; ?></label></h5>
                                
                                <p>โพสต์ขาย  : <label> <?php
                                $var_date = $regdate; // Query ออกมาได้เลยครับ

                                $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
                                $thai_month_arr=array(
                                 "0"=>"",
                                 "1"=>"มกราคม",
                                 "2"=>"กุมภาพันธ์",
                                 "3"=>"มีนาคม",
                                 "4"=>"เมษายน",
                                 "5"=>"พฤษภาคม",
                                 "6"=>"มิถุนายน", 
                                 "7"=>"กรกฎาคม",
                                 "8"=>"สิงหาคม",
                                 "9"=>"กันยายน",
                                 "10"=>"ตุลาคม",
                                 "11"=>"พฤศจิกายน",
                                 "12"=>"ธันวาคม"     
                                );
                                function thai_date($time){
                                 global $thai_day_arr,$thai_month_arr;
                                 $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
                                 $thai_date_return.= "ที่ ".date("j",$time);
                                 $thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
                                 $thai_date_return.= " พ.ศ.".(date("Y",$time)+543);
                                 //$thai_date_return.= "  ".date("H:i",$time)." น.";
                                 return $thai_date_return;
                                }
                                
                                $var_date=strtotime("$var_date"); 
                                $var_date= thai_date($var_date);
                                
                                echo $var_date;
                                 ?></label></label></p>
                                 <?php 
                                 $id_user = $_SESSION['id_user'];
                                if (!$id_user){}
                                else {
                                    $select_follow = $db->prepare("SELECT * FROM follow  WHERE id_seller='$id_seller' AND id_user = '$id_user'");
                                    $select_follow ->execute();
                                    $rowfollow = $select_follow ->fetch(PDO::FETCH_ASSOC);
                                    $seller = $rowfollow['id_seller'];
                                    
                                    
                                    if (isset($_REQUEST['btn_follow'])) {
                                        
                                        if(!$seller){
                                            $INSERT_follow = $db->prepare("INSERT INTO follow (id_user, id_seller)
                                                VALUES ($id_user, $id_seller);");
                                             $INSERT_follow->execute();
                                        
                                        echo "<script>alert('ติดตามเสร็จ')</script>";
                                        echo "<script>window.location.href='./product.php?product_id=$id_products'</script>";
                                        }else{
                                             $delete_stmt = $db->prepare("DELETE FROM follow WHERE id_seller = '$id_seller' AND id_user = '$id_user'");
                                             $delete_stmt->execute();
                                            echo "<script>alert('ยกเลิกติดตามสำเร็จ')</script>";
                                        echo "<script>window.location.href='./product.php?product_id=$id_products'</script>";
                                        }
                                    }
                                    
                                    
                                    
                                    
                                    
                                    
                                 ?>
                                 <form method="post">
                                 <p><button type="submit" name="btn_follow" class="btn btn-danger"><?php
                                 if(!$seller){echo 'ติดตามร้านค้า';}
                                 else{echo 'ติดตามร้านค้าเเล้ว';}?></button></p>
                                </form>
                                 <?php } ?>
                                <div class="bg-green py-2 px-3 mt-4" rows="4">
                                    <h2 class="mb-0">
                                        <h2>ราคา  <?php $price =  $row['price'];
                                                    $prices = intval($price);
                                                    echo number_format($prices,2); ?> บาท</h2>

                                    </h2>
                                </div>
                                    <br />
                                <?php
                                $id_user = $_SESSION['id_user'];
                                if (!$id_user) {
                                } else {
                                    if (isset($_REQUEST['sand'])) {
                                        $message = strip_tags($_REQUEST['message']);
                                        $id_seller = $rowseller['id_seller'];
                                        $status = 'user';

                                        if (empty($message)) {
                                            echo "<script>alert('กรุณาใส่ข้อความ ')</script>";
                                        } else {
                                            try {
                                                $message = ("INSERT INTO chat(id_user , id_seller , message,status ) VALUES ('$id_user','$id_seller','$message','$status')");
                                                $stmt = $db->prepare($message);
                                                $stmt->execute();
                                                echo "<script>window.location.href='product.php?product_id=$id_products'</script>";
                                            } catch (PDOException $e) {
                                                $e->getMessage();
                                            }
                                        }
                                    }
                                ?>

                                    <div class="card direct-chat direct-chat-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">ติดต่อร้านค้า</h3>
                                            <div class="card-tools">

                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="direct-chat-messages">
                                                <?php

                                                $usermes = "";
                                                $select_chart = $db->prepare("SELECT * FROM chat WHERE id_user = '$id_user' AND id_seller = '$id_seller' ");
                                                $select_chart->execute();

                                                while ($rowchart = $select_chart->fetch(PDO::FETCH_ASSOC)) {
                                                    $status = $rowchart['status'];
                                                    if ($status === 'seller') {
                                                        $usermes = '
                                                                    <!-- Message. Default to the left -->
                                                                    <div class="direct-chat-msg">
                                                                        <div class="direct-chat-infos clearfix">
                                                                            <span class="direct-chat-name float-left">' . $firstname = $rowshop['nameshop'] . '</span>
                                                                            
                                                                        </div>
                                                                        <img class="direct-chat-img" src="./upload/shop/'.$rowshop['image'].'" alt="message user image">
                                                                        <div class="direct-chat-text">
                                                                            ' . $rowchart['message'] . '
                                                                        </div>
                                                                    </div>';
                                                                echo $usermes;
                                                    } else {
                                                        $usermes = '<div class="direct-chat-msg right">
                                                                    <div class="direct-chat-infos clearfix">
                                                                        <span class="direct-chat-name float-right">' .              $firstname = $_SESSION['firstname'] . '</span>
                                                                        
                                                                    </div>
                                                                    <img class="direct-chat-img" src="./upload/user/'.$img = $_SESSION['image'].'" alt="message user image">
                                                                    <div class="direct-chat-text">
                                                                        ' . $rowchart['message'] . '
                                                                    </div>
                                                                </div>';
                                                        echo $usermes;
                                                    }
                                                }
                                                ?>
                                                
                                                
                                                <!-- /.card-footer-->
                                            </div>
                                            <div class="card-footer">
                                                    <form action="" method="post">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="ข้อความ..." id='message' name="message">
                                                            <span class="input-group-append">
                                                                <button type="submit" name="sand" class="btn btn-warning">ส่ง</button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            <!--/.direct-chat -->
                                        </div>
                                        <!-- /.col -->
                                    <?php } ?>

                                    </div>
                            </div>
                            </div>
                        </div>
                        <hr />
                        <?php include './seller/components/shopproduct.php' ?>
                        <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                            <a href="shopproduct.php?shop_id=<?php echo $id_shop; ?>" class="btn btn-primary">สินค้าเพิ่มเติมจากร้านค้า</a>
                            </div>
                        </div>
                        
                    </div>
                    <br/>
                    
                     <div class="alert alert-primary" role="alert">
                        สินค้าคล้ายกัน
                    </div>
                     <div class="container mt-4">
                <div class="row">
                    <?php
                   

                    $select_stmt = $db->prepare("SELECT * FROM products WHERE id_subcategory = '$id_subcategory' ");
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
                    
                     
                </div>
               
           
            <br/>
            
               
            </div>
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