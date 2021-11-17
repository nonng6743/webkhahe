<?php
require_once('../connection.php');
session_start();
error_reporting(0);

if (!$_SESSION['id_admin']) {
    header("location: loginAdmin.php");
} else {

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM products WHERE id_products= :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("../upload/" . $row['imgUrl']); // unlin functoin permanently remove your file

        // delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM shops WHERE id_shop = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header("Location: editproducts.php");
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>หน้าจัดการสินค้า</title>

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
                                <h1 class="m-0">หน้าจัดการสินค้าทั้งหมด</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">จัดการสินค้าทั้งหมด</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ร้านค้า</th>

                                                    <th>ประเภท</th>
                                                    <th>รูปภาพสินค้า</th>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>ราคา</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $select_stmt = $db->prepare('SELECT * FROM products');
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $i = $i + 1;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>

                                                        <td><?php $id_shop = $row['id_shop'];
                                                            $select_shop  = $db->prepare("SELECT * FROM shops WHERE id_shop = '$id_shop' ");
                                                            $select_shop->execute();
                                                            $rowshop  = $select_shop->fetch(PDO::FETCH_ASSOC);
                                                            echo $rowshop['nameshop'];
                                                            ?></td>

                                                        <td><?php $id_subcategory = $row['id_subcategory'];
                                                            $select_subcategory  = $db->prepare("SELECT * FROM subcategories WHERE id_subcategory = '$id_subcategory' ");
                                                            $select_subcategory->execute();
                                                            $rowsubcategory  = $select_subcategory->fetch(PDO::FETCH_ASSOC);
                                                            echo $rowsubcategory['namesubcategory']; ?></td>
                                                        <td><img src="../upload/product/<?php echo $row['image']; ?>" width="40px" height="40px" alt=""></td>
                                                        <td><?php echo $row['nameproduct']; ?></td>
                                                        <td><?php echo $row['price']; ?></td>
                                                        <td><a href="?delete_id=<?php echo $row['id_products']; ?>" class="btn btn-danger">Delete</a></td>

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