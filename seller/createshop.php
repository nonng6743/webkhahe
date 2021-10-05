<?php
include_once('../functions.php');
$userdata = new DB_con();

session_start();
$id_seller = $_SESSION['id_seller'];
$fastname =  $_SESSION['fastname'];

$sqlidseller = $userdata->quertyidseller($id_seller);
$num = mysqli_num_rows($sqlidseller);

if ($id_seller == "") {
    header("location: signin.php");
}
if ($num > 0) {
    echo "<script>alert('มีร้านค้าอยู่ในบัญชีเเล้ว')</script>";
    echo "<script>window.location.href='dashboardseller.php'</script>";
} else {


    if (isset($_POST['submit'])) {
        
        $nameshop = $_POST['nameshop'];
        $lat = ($_POST['lat']);
        $lon = $_POST['lng'];


        $sql = $userdata->createshop($id_seller, $nameshop, $lat, $lon);
        if ($sql) {
            echo "<script>alert('Ragistor Successfull')</script>";
            echo "<script>window.location.href='dashboardseller.php'</script>";
        } else {
            echo "<script>alert('Something went wrong! Please try again...')</script>";
            //echo "<script>window.location.href='createshop.php'</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Shop</title>
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
                            <h1 class="m-0">Create Shop Page</h1>
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Craete Shop</h3>
                                        </h3>
                                    </div>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card-body">

                                        <div class="form-group">

                                            <label for="name">Name Shop</label>
                                            <input type="text" class="form-control" id="nameshop" name="nameshop" placeholder="Name Shop">
                                        </div>
                                        <div class="form-group">
                                            <label for="lat">Lat</label>
                                            <input type="text" class="form-control" id="lat" name="lat" placeholder="lat">
                                        </div>
                                        <div class="form-group">
                                            <label for="Lng">Lng</label>
                                            <input type="text" class="form-control" id="lng" name="lng" placeholder="Lng">
                                        </div>
                                        <div class="form-group">
                                            <?php include './components/googlemap/index.php' ?>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary ">Create Shop</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>

</body>

</html>