<?php
require_once('../connection.php');
session_start();
error_reporting(0);
$id_manager = $_SESSION['id_manager'];
if ($_SESSION['id_manager'] == "") {
    header("location: signin.php");
} else {
    $id_seller = $_REQUEST['shop_id'];
   
    $select_shop = $db->prepare("SELECT * FROM shops WHERE id_seller = '$id_seller' ");
    $select_shop->execute();
    $rowshop = $select_shop->fetch(PDO::FETCH_ASSOC);



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>หน้าติดต่อร้านค้า</title>

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
                                <h1 class="m-0">หน้าติดต่อร้านค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    
                                    <br />
                                    <?php
                                    if (isset($_REQUEST['sand'])) {
                                        $message = strip_tags($_REQUEST['message']);
                                        
                                        $status = 'manager';

                                        if (empty($message)) {
                                            echo "<script>alert('กรุณาใส่ข้อความ ')</script>";
                                        } else {
                                            try {
                                                $message = ("INSERT INTO chatmanager(id_seller , message,status ) VALUES ('$id_seller','$message','$status')");
                                                $stmt = $db->prepare($message);
                                                $stmt->execute();
                                                echo "<script>window.location.href='chartsellerid.php?shop_id=$id_seller'</script>";
                                            } catch (PDOException $e) {
                                                $e->getMessage();
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="card direct-chat direct-chat-warning card-primary"">
                                        <div class="card-header">
                                            <h3 class="card-title">ติดด่อลูกค้า</h3>
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
                                                $select_chart = $db->prepare("SELECT * FROM chatmanager WHERE id_seller = '$id_seller' ");
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
                                                                        <img class="direct-chat-img" src="../upload/shop/'.$rowshop['image'].'" alt="message user image">
                                                                        <div class="direct-chat-text">
                                                                            ' . $rowchart['message'] . '
                                                                        </div>
                                                                    </div>';
                                                        echo $usermes;
                                                    } else {
                                                        $usermes = '<div class="direct-chat-msg right">
                                                                    <div class="direct-chat-infos clearfix">
                                                                        <span class="direct-chat-name float-right">ผู้จัดการตลาด</span>
                                                                        
                                                                    </div>
                                                                    <img class="direct-chat-img" src="../upload/Profile-Transparent.png" alt="message user image">
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

                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>

    </body>

    </html>


    </body>

    </html>

<?php
}
?>