<?php
include_once('../functions.php');
$userdata = new DB_con();
session_start();

if ($_SESSION['id_manager'] == "") {
    header("location: loginManager.php");
} else {

    if (isset($_POST['submit'])) {

        $namearea = $_POST['namearea'];
        $detail = $_POST['detail'];
        $scale = $_POST['scale'];
        $rentalfee = $_POST['rentalfee'];
        $lat = ($_POST['lat']);
        $lng = $_POST['lng'];

        $imgUrl = $_FILES['imgUrl']['name'];
        $type = $_FILES['imgUrl']['type'];
        $size = $_FILES['imgUrl']['size'];
        $temp = $_FILES['imgUrl']['tmp_name'];

        $path = "../upload/area/" . $imgUrl; // set upload folder path

        if (empty($namearea)) {
            $errorMsg = "Please Enter namearea";
        } else if (empty($imgUrl)) {
            $errorMsg = "please Select Image";
        } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
            if (!file_exists($path)) { // check file not exist in your upload folder path
                if ($size < 5000000) { // check file size 5MB
                    move_uploaded_file($temp, '../upload/area/' . $imgUrl); // move upload file temperory directory to your upload folder
                } else {
                    $errorMsg = "Your file too large please upload 5MB size"; // error message file size larger than 5mb
                }
            } else {
                $errorMsg = "File already exists... Check upload filder"; // error message file not exists your upload folder path
            }
        } else {
            $errorMsg = "Upload JPG, JPEG, PNG & GIF file formate...";
        }

        if (!isset($errorMsg)) {
            $sql = $userdata->createarea($namearea, $lat, $lng, $imgUrl,$detail,$scale,$rentalfee );
            if ($sql) {
                echo "<script>alert('สร้างเเผงร้านค้าสำเร็จ')</script>";
                echo "<script>window.location.href='dashboard.php'</script>";
            } else {
                echo "<script>alert('ผิดพลาด โปรดลองอีกครั้ง..')</script>";
                echo "<script>window.location.href='add_area.php'</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มแผงขายสินค้า</title>
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
                            <h1 class="m-0">หน้าจัดการแผงขายสินค้า</h1>
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">เพิ่มแผงขายสินค้า</h3>
                                        </h3>
                                    </div>
                                </div>
                                <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <?php
                                    if (isset($errorMsg)) {
                                    ?>
                                        <div class="alert alert-danger">
                                            <strong><?php echo $errorMsg; ?></strong>
                                        </div>
                                    <?php
                                    }

                                    ?>
                                    <?php
                                    if (isset($insertMsg)) {
                                    ?>
                                        <div class="alert alert-success">
                                            <strong><?php echo $insertMsg; ?></strong>
                                        </div>
                                    <?php } ?>
                                    <div class="card-body">

                                        <div class="form-group">

                                            <label for="name">ชื่อเเผงร้านค้า</label>
                                            <input type="text" class="form-control" id="namearea" name="namearea" placeholder="ชื่อแผงขายสินค้า">
                                        </div>
                                        <div class="form-group">
                                            <label for="detail">รายละเอียดเเผงร้านค้า</label>
                                            <input type="text" class="form-control" id="detail" name="detail" placeholder="รายละเอียด">
                                        </div>
                                         <div class="form-group">
                                            <label for="scale">ขนาดเเผงร้านค้า</label>
                                            <input type="text" class="form-control" id="scale" name="scale" placeholder="ขนาดเเผงร้านค้า">
                                        </div>
                                        <div class="form-group">
                                            <label for="rentalfee">ราคาค่าเช่าเเผงร้านค้า</label>
                                            <input type="number" class="form-control" id="rentalfee" name="rentalfee" >
                                        </div>
                                        <div class="form-group">
                                            <label for="name">รูปเเผงร้านค้า</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="imgUrl" name="imgUrl">
                                                    <label class="custom-file-label" for="imgUrl name=" imgUrl">Choose file</label>
                                                </div>
                                            </div>
                                            <!--<div class="form-group">-->
                                            <!--    <label for="lat">Lat</label>-->
                                            <!--    <input type="text" class="form-control" id="lat" name="lat" placeholder="lat">-->
                                            <!--</div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <label for="Lng">Lng</label>-->
                                            <!--    <input type="text" class="form-control" id="lng" name="lng" placeholder="Lng">-->
                                            <!--</div>-->
                                            <div class="form-group">
                                                <?php include '../seller/components/googlemap/index.php' ?>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary ">สร้างเเผงร้านค้า</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>

</body>

</html>