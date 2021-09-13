<?php
require_once('../connection.php');
session_start();
if ($_SESSION['id_admin'] == "") {
    header("location: signin.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
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
                                <h1 class="m-0">Dashboard </h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard </li>
                                </ol>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                        <h5 class="mb-2 mt-4">Report</h5>
                        <br/>
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <br />
                                    <div class="inner">
                                        <?php
                                        $sql = "SELECT COUNT(*) FROM products";
                                        $res = $db->query($sql);
                                        $count_product = $res->fetchColumn();
                                        ?>

                                        <h3><?php echo $count_product ?></h3>

                                        <p>สินค้าในระบบ</p>
                                        <br />

                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small card -->
                                <div class="small-box bg-purple">
                                    <br />
                                    <div class="inner">
                                        <?php
                                        $sql_shops = "SELECT COUNT(*) FROM shops";
                                        $res = $db->query($sql_shops);
                                        $count_shops = $res->fetchColumn();
                                        ?>

                                        <h3><?php echo $count_shops ?></h3>

                                        <p>ร้านค้าในระบบ</p>
                                        <br />

                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-store"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small card -->
                                <div class="small-box bg-success">
                                    <br />
                                    <div class="inner">
                                        <?php
                                        $sql_sellers = "SELECT COUNT(*) FROM sellers";
                                        $res = $db->query($sql_sellers);
                                        $count_sellers = $res->fetchColumn();
                                        ?>

                                        <h3><?php echo $count_sellers ?></h3>

                                        <p>ผู้ขายในระบบ</p>
                                        <br />
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small card -->
                                <div class="small-box bg-danger">
                                    <br />
                                    <div class="inner">
                                        <?php
                                        $sql_manager = "SELECT COUNT(*) FROM managers";
                                        $res = $db->query($sql_manager);
                                        $count_managers = $res->fetchColumn();
                                        ?>

                                        <h3><?php echo $count_managers ?></h3>

                                        <p>ผู้จัดการในระบบ</p>
                                    </div>
                                    <br />
                                    <div class="icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small card -->
                                <div class="small-box bg-warning">
                                    <br />
                                    <div class="inner">
                                        <?php
                                        $sql_users = "SELECT COUNT(*) FROM users";
                                        $res = $db->query($sql_users);
                                        $count_users = $res->fetchColumn();
                                        ?>

                                        <h3><?php echo $count_users ?></h3>
                                        <p>ผู้ใข้งานในระบบ</p>
                                    </div>
                                    <br />
                                    <div class="icon">
                                        <i class="fas fa-user"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->

                            <!-- ./col -->
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>
    </body>

    </html>

<?php
}
?>