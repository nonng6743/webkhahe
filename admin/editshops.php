<?php
require_once('../../projectweb/connection.php');
session_start();

if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM shops WHERE id_shop = :id');
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
                                            <h3 class="card-title">Edit Products</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Name Shop</th>
                                                    <th>ID Seller</th>
                                                    <th>Date</th>
                                                    <th>Area</th>
                                                    <th>location</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_stmt = $db->prepare('SELECT * FROM shops');
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['nameshop']; ?></td>
                                                        <td><?php echo $row['id_seller']; ?></td>
                                                        <td><?php echo $row['regdate']; ?></td>
                                                        <td><?php echo $row['id_area']; ?></td>
                                                        <td><?php echo $row['lat'] ," , ", $row['lon']; ?></td>
                                                        <td><a href="?delete_id=<?php echo $row['id_seller']; ?>" class="btn btn-danger">Delete</a></td>

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