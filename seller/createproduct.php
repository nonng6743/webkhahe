<?php
include_once('../functions.php');
require_once('connection.php');
$userdata = new DB_con();
session_start();

if ($_SESSION['id_seller'] == "") {
    header("location: signin.php");
} else {
    $id_seller = $_SESSION['id_seller'];
    $result = $userdata->quertyshops($id_seller);
    $num = mysqli_fetch_array($result);
    $id_shop = $num['id_shop'];

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $imgUrl = $_FILES['imgUrl']['name'];
        $type = $_FILES['imgUrl']['type'];
        $size = $_FILES['imgUrl']['size'];
        $temp = $_FILES['imgUrl']['tmp_name'];

        $path = "../upload/product/" . $imgUrl; // set upload folder path

        if (empty($name)) {
            $errorMsg = "Please Enter name";
        } else if (empty($imgUrl)) {
            $errorMsg = "กรุณาอัพโหลดรูปภาพของท่าน";
        } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
            if (!file_exists($path)) { // check file not exist in your upload folder path
                if ($size < 5000000) { // check file size 5MB
                    move_uploaded_file($temp, '../upload/product/'.$imgUrl); // move upload file temperory directory to your upload folder
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
            $sql = $userdata->createproducts($id_shop, $name, $description, $price, $category, $imgUrl);
            if ($sql) {
                echo "<script>alert('เพิ่มสินค้าสำเร็จ')</script>";
                echo "<script>window.location.href='../seller/dashboardseller.php'</script>";
            } else {
                echo "<script>alert('มีปัญหาโปรดลองอีกครั้ง...')</script>";
                echo "<script>window.location.href='../seller/createproduct.php'</script>";
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
        <title>เพิ่มสินค้า</title>
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
                                <h1 class="m-0">หน้าเพิ่มสินค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">เพิ่มสินค้า</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">

                                            <div class="form-group">

                                                <label for="name">ชื่อสินค้าของคุณ</label>
                                               <input type="name" class="form-control form-control-lg" id='name' name="name" onblur="checkname(this.value)">
                                                <br /> <span id="nameavailable"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">รายละเอียดสินค้าของคุณ</label>
                                                <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">ประเภทสินค้าของคุณ</label>
                                                <br />
                                                <select class="form-select" type="category" id='category' name="category">
                                                    <?php
                                                    $select_stmt = $db->prepare("SELECT * FROM subcategories ");
                                                    $select_stmt->execute();

                                                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option value="<?php echo $row['id_subcategory'] ?>"><?php echo $row['namesubcategory'] ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="price">ราคา</label>
                                                <input type="number" class="form-control" id="price" name="price" placeholder="Price Product">
                                            </div>
                                            <div class="form-group">
                                                <label for="imgUrl">รูปภาพสินค้าของคุณ</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" for="imgUrl" name=" imgUrl">
                                                        <label class="custom-file-label" for="imgUrl" name=" imgUrl">Choose file</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary ">เพิ่มสินค้า</button>
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
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script>
            function checkname(val) {
                $.ajax({
                    type: 'POST',
                    url: 'checknameproduct.php',
                    data: 'name=' + val,
                    success: function(data) {
                        $('#nameavailable').html(data);
                    }
                });
            }
        </script>

    </body>

    </html>

<?php
}
?>