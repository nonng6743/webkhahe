<?php
require_once('../connection.php');
session_start();

if ($_SESSION['id_manager'] == "") {
    header("location: signin.php");
} else {
    


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chart </title>
        
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
                                <h1 class="m-0">หน้าแชท</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">รายชื่อผู้ติดต่อคุณ</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อร้านค้าที่ติดต่อ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i =0;
                                                
                                                $select_stmt = $db->prepare("SELECT DISTINCT id_seller FROM chatmanager ");
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                     $i = $i+1;                                            
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i?></td>
                                                        <td><?php $id_seller = $row['id_seller'];
                                                                  $select_shop = $db->prepare("SELECT * FROM shops WHERE id_seller = '$id_seller'");
                                                                    $select_shop->execute();
                                                                    $rowshop = $select_shop->fetch(PDO::FETCH_ASSOC);
                                                                    echo $rowshop['nameshop'];
                                                                     ?></td>
                                                       
                                                        <td><a href="chartsellerid.php?shop_id=<?php echo $id_seller; ?>" class="btn btn-warning">ติดต่อ</a></td>
                                                        

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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