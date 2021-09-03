<?php
require_once('connection.php');
session_start();

if ($_SESSION['id_seller'] == "") {
    header("location: signin.php");
} else {
    $id_seller = $_SESSION['id_seller'];
    $select_stmt = $db->prepare('SELECT * FROM shops WHERE id_seller = :id');
    $select_stmt->bindParam(":id", $id_seller);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);



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
                                <h1 class="m-0">Shop Page</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Profile Shop</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="./dist/img/user4-128x128.jpg" alt="User profile picture">
                                            </div>
                                            <strong>Name Shop </strong>
                                            <p class="text-muted">
                                                <?php echo $nameshop; ?>
                                            </p>
                                            <hr>

                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                            <p class="text-muted"> <?php echo $lat; ?>, <?php echo $lon; ?></p>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

    </body>

    </html>


    </body>

    </html>

<?php
}
?>