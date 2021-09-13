<?php
require_once('../../projectweb/connection.php');
session_start();

if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare('SELECT * FROM managers WHERE id_manager= :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $delete_stmt = $db->prepare('DELETE FROM managers WHERE id_manager = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header("Location: editmanagers.php");
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Manager</title>

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
                                <h1 class="m-0">Edit Manager Page</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Managers</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID Manager</th>
                                                    <th>Fast Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_stmt = $db->prepare('SELECT * FROM managers');
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['id_manager']; ?></td>
                                                        <td><?php echo $row['fastname']; ?></td>
                                                        <td><?php echo $row['lastname']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><a href="?delete_id=<?php echo $row['id_manager']; ?>" class="btn btn-danger">Delete</a></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <a href="addManager.php" class="btn btn-info">Add Manager</a>
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