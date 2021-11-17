<?php
include_once('../functions.php');
require_once('../connection.php');
$userdata = new DB_con();
session_start();

if ($_SESSION['id_manager'] == "") {
    header("location: signin.php");
} else {
    
    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM shops WHERE id_shop = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("../upload/shop/".$row['image']); // unlin functoin permanently remove your file

        // delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM shop WHERE id_shop = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header("Location: editshops.php");
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>หน้าจัดการร้านค้า</title>
        
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
                                <h1 class="m-0">หน้าจัดการร้านค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">จัดการร้านค้า</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>รูปภาพร้านค้า</th>
                                                    <th>ชื่อร้านค้า</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $select_stmt = $db->prepare("SELECT * FROM shops ");
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $i = $i+1;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><img src="../upload/shop/<?php echo $row['image']; ?>" width="40px" height="40px" alt=""></td>
                                                        <td><?php echo $row['nameshop']; ?></td>
                                                        
                                                        <td><a href="shopsupdate.php?updateshop_id=<?php echo $row['id_shop']; ?>" class="btn btn-warning">เเก้ไข</a></td>
                                                        
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