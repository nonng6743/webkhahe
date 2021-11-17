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


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chart </title>
        
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
                                <h1 class="m-0">หน้าแชท</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">รายชื่อผู้ติดต่อคุณ</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อผู้ติดต่อ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i =0;
                                                $id_seller = $_SESSION['id_seller'];
                                                $select_stmt = $db->prepare("SELECT DISTINCT id_user FROM chat WHERE id_seller = '$id_seller'");
                                                $select_stmt->execute();

                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                     $i = $i+1;                                            
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i?></td>
                                                        <td><?php $id_user = $row['id_user'];
                                                                    $select_user = $db->prepare("SELECT * FROM users WHERE id_user = '$id_user'");
                                                                    $select_user->execute();
                                                                    $rowuser = $select_user->fetch(PDO::FETCH_ASSOC);
                                                                    echo $rowuser['firstname'] ?></td>
                                                       
                                                        <td><a href="chartuser.php?user_id=<?php echo $row['id_user']; ?>" class="btn btn-warning">ติดต่อ</a></td>
                                                        

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