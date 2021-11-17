<?php
require_once('../connection.php');
session_start();
 error_reporting(0);

if (!$_SESSION['id_admin'] ) {
    header("location: loginAdmin.php");
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
        <title>หน้าจัดการผู้จัดการตลาด</title>

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
                                <h1 class="m-0">หน้าจัดการผู้จัดการตลาด</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">จัดการผู้จัดการตลาด</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อจริง</th>
                                                    <th>นามสกุล</th>
                                                    <th>Email</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $select_stmt = $db->prepare('SELECT * FROM managers');
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $i =$i+1;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['firstname']; ?></td>
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