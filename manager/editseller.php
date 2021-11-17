<?php
require_once('../connection.php');
session_start();
 error_reporting(0);

if (!$_SESSION['id_manager']) {
    header("location: loginManager.php");
} else {

    if (isset($_REQUEST['approve_id'])) {
        $id = $_REQUEST['approve_id'];

        $select_stmt = $db->prepare('SELECT * FROM sellers WHERE id_seller = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        

        
        $roleapprove = "seller";
        $approve_stmt = $db->prepare('UPDATE sellers SET role = :role_up  WHERE id_seller = :id');
        $approve_stmt->bindParam(':id', $id);
        $approve_stmt->bindParam(':role_up', $roleapprove);
        $approve_stmt->execute();

        header("Location: editseller.php");
    }
    
     if (isset($_REQUEST['delete_id'])) {
        $deleteid = $_REQUEST['delete_id'];
        
         $select_stmt = $db->prepare('SELECT * FROM sellers WHERE id_seller= :id');
        $select_stmt->bindParam(':id', $deleteid);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("../upload/seller/".$row['image']); // unlin functoin permanently remove your file
        
        $delete_stmt = $db->prepare('DELETE FROM sellers  WHERE id_seller = :id');
        $delete_stmt->bindParam(':id', $deleteid);
        $delete_stmt->execute();

        header("Location: editseller.php");
    }

   
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>อนุมัติผู้ขาย</title>

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
                                <h1 class="m-0">หน้าอนุมัติผู้ขาย</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">อนุมัติผู้ขาย</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อ</th>
                                                    <th>นามสกุล</th>
                                                    <th>อีเมล</th>
                                                    <th>เพศ</th>
                                                    <th>เบอร์โทรศัพท์</th>
                                                    <th>รหัสประชาชน</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_stmt = $db->prepare('SELECT * FROM sellers where role="noseller"');
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['firstname']; ?></td>
                                                        <td><?php echo $row['lastname']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['gender']; ?></td>
                                                        <td><?php echo $row['phone'] ; ?></td>
                                                        <td><?php echo $row['idcard'] ; ?></td>
                                                        <td><a href="?approve_id=<?php echo $row['id_seller']; ?>" class="btn btn-success">อนุมัติ</a></td>
                                                        <td><a href="?delete_id=<?php echo $row['id_seller']; ?>" class="btn btn-danger">ไม่อนุมัติ</a></td>
                                                        
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