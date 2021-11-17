<?php
require_once('../connection.php');
session_start();

if ($_SESSION['id_manager'] == "") {
    header("location: signin.php");
} else {

    if (isset($_REQUEST['Reserve_id'])) {
        $id = $_REQUEST['Reserve_id'];
        $select_reserve_area = $db->prepare('SELECT * FROM reserve_area WHERE id_seller = :id');
        $select_reserve_area->bindParam(':id', $id);
        $select_reserve_area->execute();
        $rowreserve_area = $select_reserve_area->fetch(PDO::FETCH_ASSOC);
        $areaid =  $rowreserve_area['id_area'];

        $select_area = $db->prepare('SELECT * FROM area WHERE id_area = :id');
        $select_area->bindParam(':id', $areaid);
        $select_area->execute();
        $rowarea = $select_area->fetch(PDO::FETCH_ASSOC);
        $lat = $rowarea['lat'];
        $lng = $rowarea['lng'];
        
        


        $select_updateshop = $db->prepare("UPDATE shops SET id_area = $areaid, lat = $lat, lng = $lng WHERE id_seller = $id");
        $select_updateshop->execute();
       

        $select_updatearea = $db->prepare("UPDATE area SET id_seller = '$id' WHERE id_area = '$areaid'");
        $select_updatearea->execute();
        

        $delete_stmt = $db->prepare("DELETE FROM reserve_area WHERE id_seller = '$id'");
        $delete_stmt->execute();

        echo "<script>alert('ทำการอนุมัติเรียบร้อยเเล้ว')</script>";
        echo "<script>window.location.href='./dashboard.php'</script>";




    }
     if (isset($_REQUEST['delete_id'])) {
        $deleteid = $_REQUEST['delete_id'];
        
        
        
        $delete_stmt = $db->prepare('DELETE FROM reserve_area  WHERE id_seller = :id');
        $delete_stmt->bindParam(':id', $deleteid);
        $delete_stmt->execute();

        echo "<script>alert('ทำการไม่อนุมัติร้านค้าเรียบร้อยเเล้ว')</script>";
        echo "<script>window.location.href='./dashboard.php'</script>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ร้านค้าที่ต้องการจองเเผงร้านค้า</title>

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
                                <h1 class="m-0">ร้านค้าที่ต้องการจองเเผงร้านค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">ร้านค้าที่รอการอนุมัติ</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อผู้ขาย</th>
                                                    <th>รูปเเผง</th>
                                                    <th>ชื่อเเผงร้านค้า</th>
                                                    <th>เบอร์ผู้ขาย</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_stmt = $db->prepare("SELECT * FROM reserve_area ");
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php
                                                            $id_seller = $row['id_seller'];
                                                            $select_seller = $db->prepare("SELECT * FROM sellers WHERE id_seller='$id_seller'");
                                                            $select_seller->execute();
                                                            $rowseller = $select_seller->fetch(PDO::FETCH_ASSOC);
                                                            echo $rowseller['firstname'];  ?></td>
                                                        <td><img src="../upload/area/<?php
                                                                                        $id_area = $row['id_area'];
                                                                                        $select_area = $db->prepare("SELECT * FROM area WHERE id_area='$id_area'");
                                                                                        $select_area->execute();
                                                                                        $rowarea = $select_area->fetch(PDO::FETCH_ASSOC);
                                                                                        echo $rowarea['image']; ?>" width="40px" height="40px" alt=""></td>
                                                        <td><?php echo $rowarea['namearea']; ?></td>
                                                        <td><?php echo $rowseller['phone']; ?></td>
                                                        <td><a href="?Reserve_id=<?php echo $row['id_seller']; ?>" class="btn btn-warning">อนุมัติ</a></td>
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