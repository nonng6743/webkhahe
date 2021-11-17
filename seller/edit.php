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

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM products WHERE id_products = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("../upload/product/".$row['image']); // unlin functoin permanently remove your file

        // delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM products WHERE id_products = :id');
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
        <title>แก้ไขสินค้า</title>
        
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
                                <h1 class="m-0">หน้าแก้ไขสินค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">แก้ไขสินค้า</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อสินค้า</th>
                                                    
                                                    <th>ราคา</th>
                                                    
                                                    <th>รูปภาพ</th>
                                                    <th>รายละเอียด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_stmt = $db->prepare("SELECT * FROM products WHERE id_shop = $id_shop");
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['nameproduct']; ?></td>
                                                        
                                                        <td><?php echo $row['price']; ?></td>
                                                        
                                                        <td><img src="../upload/product/<?php echo $row['image']; ?>" width="40px" height="40px" alt=""></td>
                                                        <td><?php echo $row['detail']; ?></td>
                                                        <td><a href="edit.php?update_id=<?php echo $row['id_products']; ?>" class="btn btn-warning">แก้ไข</a></td>
                                                        <td><a href="?delete_id=<?php echo $row['id_products']; ?>" class="btn btn-danger">ลบ</a></td>

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