<?php
include_once('../functions.php');
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

        $path = "../upload/" . $imgUrl; // set upload folder path

        if (empty($name)) {
            $errorMsg = "Please Enter name";
        } else if (empty($imgUrl)) {
            $errorMsg = "please Select Image";
        } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
            if (!file_exists($path)) { // check file not exist in your upload folder path
                if ($size < 5000000) { // check file size 5MB
                    move_uploaded_file($temp, '../upload/' . $imgUrl); // move upload file temperory directory to your upload folder
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
            $sql = $userdata->createproducts($id_shop, $name, $description, $price, $category,$imgUrl);
            if ($sql) {
                echo "<script>alert('Cearte Successfull')</script>";
                echo "<script>window.location.href='../seller/dashboardseller.php'</script>";
            } else {
                echo "<script>alert('Something went wrong! Please try again...')</script>";
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
        <title>Create Product</title>
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
                                <h1 class="m-0">Create Product Page</h1>
                                <hr/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Craete Products</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">

                                            <div class="form-group">

                                                <label for="name">Name Products</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name Product">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description Products</label>
                                                <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category Product</label>
                                                <input type="text" class="form-control" id="category" name="category" placeholder="category Product">
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" id="price" name="price" placeholder="Price Product">
                                            </div>
                                            <div class="form-group">
                                                <label for="imgUrl">Image Product</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="imgUrl" name="imgUrl">
                                                        <label class="custom-file-label" for="imgUrl name=" imgUrl">Choose file</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary ">Create Product</button>
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

<?php
}
?>