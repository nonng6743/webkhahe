<?php
require_once('../connection.php');
session_start();

if ($_SESSION['id_manager'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['updateshop_id'])) {
        try {
            $id_shops = $_REQUEST['updateshop_id'];
            $select_stmt = $db->prepare('SELECT * FROM shops WHERE id_shop = :id');
            $select_stmt->bindParam(":id", $id_shops);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        try {

            $name = $_REQUEST['name'];
           

            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE shops SET nameshop = :name_up WHERE id_shop = :id");
                $update_stmt->bindParam(':name_up', $name);
                $update_stmt->bindParam(':id', $id_shops);

                if ($update_stmt->execute()) {
                    $updateMsg = "แก้ไขร้านค้าสำเร็จ ...";
                    header("refresh:2;editshops.php");
                }
            }
            
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>หน้าเเก้ไขร้านค้า</title>

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
                                <h1 class="m-0">หน้าแก้ไขร้านค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">แก้ไขร้านค้า</h3>
                                        </div>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="name">ชื่อร้านค้า</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $nameshop; ?>">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="btn_update" class="btn btn-success" >แก้ไข</button>
                                                <a href="editshops.php" class="btn btn-danger">ยกเลิก</a>
                                            </div>
                                        </div>
                                        <div class="container text-center">
                                            <?php
                                            if (isset($errorMsg)) {
                                            ?>
                                                <div class="alert alert-danger">
                                                    <strong><?php echo $errorMsg; ?></strong>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if (isset($insertMsg)) {
                                            ?>
                                                <div class="alert alert-success">
                                                    <strong><?php echo $insertMsg; ?></strong>
                                                </div>
                                            <?php } ?>
                                    </form>
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