<?php
require_once('connection.php');
session_start();

if ($_SESSION['id_seller'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['update_id'])) {
        try {
            $id_products = $_REQUEST['update_id'];
            $select_stmt = $db->prepare('SELECT * FROM products WHERE id_products = :id');
            $select_stmt->bindParam(":id", $id_products);
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
            $description = $_REQUEST['description'];
            $category = $_REQUEST['category'];
            $price = $_REQUEST['price'];

            $imgUrl = $_FILES['imgUrl']['name'];
            $type = $_FILES['imgUrl']['type'];
            $size = $_FILES['imgUrl']['size'];
            $temp = $_FILES['imgUrl']['tmp_name'];

            $path = "../upload/".$imgUrl;
            $directory = "../upload/"; // set uplaod folder path for upadte time previos file remove and new file upload for next use

            if ($imgUrl) {
                if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                    if (!file_exists($path)) { // check file not exist in your upload folder path
                        if ($size < 5000000) { // check file size 5MB
                            unlink($directory.$row['imgUrl']); // unlink functoin remove previos file
                            move_uploaded_file($temp, '../upload/'.$imgUrl); // move upload file temperory directory to your upload folder
                        } else {
                            $errorMsg = "Your file to large please upload 5MB size";
                        }
                    } else {
                        $errorMsg = "File already exists... Check upload folder";
                    }
                } else {
                    $errorMsg = "Upload JPG, JPEG, PNG & GIF formats...";
                }
            } else {
                $imgUrl = $row['imgUrl']; // if you not select new image than previos image same it is it.
            }

            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE products SET name = :name_up, description= :description_up, category= :category_up, price=:price_up, imgUrl = :file_up WHERE id_products = :id");
                $update_stmt->bindParam(':name_up', $name);
                $update_stmt->bindParam(':description_up', $description);
                $update_stmt->bindParam(':category_up', $category);
                $update_stmt->bindParam(':price_up', $price);
                $update_stmt->bindParam(':file_up', $imgUrl);
                $update_stmt->bindParam(':id', $id_products);

                if ($update_stmt->execute()) {
                    $updateMsg = "File update successfully...";
                    header("refresh:2;editproducts.php");
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
        <title>Edit Product</title>

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
                                <h1 class="m-0">Edit Product Page</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Craete Products</h3>
                                        </div>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="name">Name Products</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description Products</label>
                                                <textarea id="description" name="description" class="form-control" rows="4"><?php echo $description; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category Product</label>
                                                <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="imgUrl">Image Product</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="imgUrl" name="imgUrl" value="<?php echo $imgUrl; ?>">
                                                        <label class="custom-file-label" for="imgUrl name="imgUrl">Choose file</label>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <p>
                                                        <img src="../upload/<?php echo $imgUrl; ?>" height="100" width="100" alt="">
                                                </p>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="btn_update" class="btn btn-success" >Update</button>
                                                <a href="editproducts.php" class="btn btn-danger">Cancel</a>
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