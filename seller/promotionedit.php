<?php
require_once('connection.php');
session_start();

if ($_SESSION['id_seller'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['update_id'])) {
        try {
            $id_promotionseller = $_REQUEST['update_id'];
            $select_stmt = $db->prepare('SELECT * FROM promotionseller WHERE id_promotionseller = :id');
            $select_stmt->bindParam(":id", $id_promotionseller);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        try {

            $description = $_REQUEST['description'];
            

            $image = $_FILES['image']['name'];
            $type = $_FILES['image']['type'];
            $size = $_FILES['image']['size'];
            $temp = $_FILES['image']['tmp_name'];

            $path = "../upload/promotionseller/".$image;
            $directory = "../upload/promotionseller/"; // set uplaod folder path for upadte time previos file remove and new file upload for next use

            if (empty($image)) {
            $errorMsg = "กรุณาอัพโหลดรูปภาพของท่าน";
            } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
            if (!file_exists($path)) { // check file not exist in your upload folder path
                if ($size < 5000000) { // check file size 5MB
                    move_uploaded_file($temp, '../upload/promotionseller/'.$image); // move upload file temperory directory to your upload folder
                } else {
                    $errorMsg = "กรุณาอัพโหลดรูปภาพที่มีขนาดไม่เกิน 5MB"; // error message file size larger than 5mb
                }
            } else {
                $errorMsg = "มีชื่อภาพนี้อยู่ในระบบเเล้ว กรุณาเปลี่ยนชื่อ !!!!"; // error message file not exists your upload folder path
                    }
            } else {
            $errorMsg = "กรุณาอัพโหลดภาพที่นามสกุล JPG, JPEG, PNG & G...";
            }

            if (!isset($errorMsg)) {
                unlink("../upload/promotionseller/".$row['image']);
                $update_stmt = $db->prepare("UPDATE promotionseller SET  detailpromotion= :description_up, image = :file_up WHERE id_promotionseller  = :id");
                $update_stmt->bindParam(':description_up', $description);
                $update_stmt->bindParam(':file_up', $image);
                $update_stmt->bindParam(':id', $id_promotionseller);
                $update_stmt->execute();
                
                header("refresh:2;editpromotion.php");
    
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
        <title>แก้ไขโปรโมชั่นสินค้า</title>

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
                                <h1 class="m-0">หน้าแก้ไขโปรโมชั่นสินค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">แก้ไขโปรโมชั่นสินค้า</h3>
                                        </div>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="description">รายละเอียดโปรโมชั่นสินค้า</label>
                                                <textarea id="description" name="description" class="form-control" rows="4"><?php echo $detailpromotion; ?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="image">ภาพสินค้า</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="image" value="<?php echo $image; ?>">
                                                        <label class="custom-file-label" for="image name="image"><?php echo $image; ?></label>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <p>
                                                        <img src="../upload/promotionseller/<?php echo $image; ?>" height="100" width="100" alt="">
                                                </p>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="btn_update" class="btn btn-success" >แก้ไข</button>
                                                <a href="editproducts.php" class="btn btn-danger">ยกเลิก</a>
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