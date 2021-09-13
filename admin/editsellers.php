<?php
require_once('../../projectweb/connection.php');
session_start();

if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM sellers WHERE id_seller = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("../upload/" . $row['imgUrl']); // unlin functoin permanently remove your file

        // delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM shops WHERE id_seller = :id');
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
        <title>Edit Seller</title>

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
                                <h1 class="m-0">Edit Seller Page</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Sellers</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Fast Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Phone</th>
                                                    <th>ID Card</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_stmt = $db->prepare('SELECT * FROM sellers');
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['fastname']; ?></td>
                                                        <td><?php echo $row['lastname']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['gender']; ?></td>
                                                        <td><?php echo $row['phone'] ; ?></td>
                                                        <td><?php echo $row['idcard'] ; ?></td>
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