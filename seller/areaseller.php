<?php
require_once('connection.php');
session_start();
error_reporting(0);
$id_seller = $_SESSION['id_seller'];

$select_reserve_area = $db->prepare("SELECT id_seller FROM reserve_area WHERE id_seller = '$id_seller' ");
$select_reserve_area->execute();
$count = $select_reserve_area->rowCount();

$select_area = $db->prepare("SELECT id_seller FROM area WHERE id_seller = '$id_seller' ");
$select_area->execute();
$countseller = $select_area->rowCount();

if (!$id_seller) {
    header("location: signin.php");
} elseif ($count > 0 ) {
    echo "<script>alert('จองเเผงไปเเล้วกรุณารอการอนุมัติจากผู้จัดการตลาด')</script>";
    echo "<script>window.location.href='./dashboardseller.php'</script>";

} elseif ($countseller > 0 ){
    echo "<script>alert('จองเเผงร้านค้าสำเร็จเเล้ว')</script>";
    echo "<script>window.location.href='./dashboardseller.php'</script>";

} else {
   
    if (isset($_REQUEST['Reserve_id'])) {
        $id = $_REQUEST['Reserve_id'];

        $select_stmt = $db->prepare("INSERT INTO reserve_area(id_seller,id_area) VALUES('$id_seller','$id')");
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        echo "<script>alert('ทำการจองเเผงร้านค้าสำเร็จ กรุณารอการอนุมัติจากผู้จัดการตลาด')</script>";
        echo "<script>window.location.href='./dashboardseller.php'</script>";


        
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>จองเเผงร้านค้า</title>

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
                                <h1 class="m-0">หน้าจองแผงขายสินค้า</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">จองแผงขายสินค้า</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อ</th>
                                                    <th>รูปภาพ</th>
                                                    <th>ราคาค่าเช่า</th>
                                                    <th>ขนาดเเผงร้านค้า</th>
                                                    <th>รายละเอียดเเผงร้านค้า</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_area = $db->prepare("SELECT * FROM area WHERE id_seller = 0 ");
                                                $select_area->execute();

                                                while ($row = $select_area->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['namearea']; ?></td>
                                                        <td><img src="../upload/area/<?php echo $row['image']; ?>" width="40px" height="40px" alt=""></td>
                                                        <td> ฿ <?php echo $row['rentalfee']; ?></td>
                                                        <td><?php echo $row['scale']; ?></td>
                                                        <td><?php echo $row['detail']; ?></td>
                                                        <td><a href="?Reserve_id=<?php echo $row['id_area']; ?>" class="btn btn-warning">จองเเผงตลาด</a></td>

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