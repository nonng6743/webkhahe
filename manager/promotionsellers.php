<?php
require_once('../connection.php');
session_start();

if ($_SESSION['id_manager'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['Reserve_id'])) {
        $id = $_REQUEST['Reserve_id'];
       
        $select_updateshop = $db->prepare("UPDATE promotionseller SET status = 'yes' WHERE id_promotionseller = $id");
        $select_updateshop->execute();
       

        echo "<script>alert('ทำการอนุมัติเรียบร้อยเเล้ว')</script>";
        echo "<script>window.location.href='./promotionsellers.php'</script>";




    }
     if (isset($_REQUEST['delete_id'])) {
        $deleteid = $_REQUEST['delete_id'];
        
        $delete_stmt = $db->prepare('DELETE FROM promotionseller  WHERE id_promotionseller = :id');
        $delete_stmt->bindParam(':id', $deleteid);
        $delete_stmt->execute();

        echo "<script>alert('ทำการไม่อนุมัติเรียบร้อยเเล้ว')</script>";
        echo "<script>window.location.href='./promotionsellers.php'</script>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>หน้าจัดการโปรโมชั่นจากร้านค้า</title>

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
                                <h1 class="m-0">หน้าจัดการโปรโมชั่นจากร้านค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">โปรโมชั่นจากร้านค้าที่รออนุมัติ</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อร้านค้า</th>
                                                    <th>รูปภาพ</th>
                                                    <th>รายละเอียดโปรโมชั่น</th>
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $select_stmt = $db->prepare("SELECT * FROM promotionseller WHERE status = 'no' ");
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $i = $i+1;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php
                                                            $id_seller = $row['id_seller'];
                                                            $select_seller = $db->prepare("SELECT * FROM shops WHERE id_seller='$id_seller'");
                                                            $select_seller->execute();
                                                            $rowseller = $select_seller->fetch(PDO::FETCH_ASSOC);
                                                            echo $rowseller['nameshop'];  ?></td>
                                                        <td><img src="../upload/promotionseller/<?php echo $row['image']; ?>" width="40px" height="40px" alt=""></td>
                                                        <td><?php echo $row['detailpromotion']; ?></td>
                                                        
                                                        <td><a href="?Reserve_id=<?php echo $row['id_promotionseller']; ?>" class="btn btn-warning">อนุมัติ</a></td>
                                                        <td><a href="?delete_id=<?php echo $row['id_promotionseller']; ?>" class="btn btn-danger">ไม่อนุมัติ</a></td>
                                                         
                                                    
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