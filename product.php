<?php
require_once('connection.php');
session_start();
error_reporting(0);
$id_user = $_SESSION['id_user'] || "0";

if (isset($_REQUEST['product_id'])) {
    try {
        $id_products = $_REQUEST['product_id'];
        $select_stmt = $db->prepare('SELECT * FROM products WHERE id_products = :id');
        $select_stmt->bindParam(":id", $id_products);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);

        $sql = "INSERT INTO actionclickuser(id_user , id_products) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_user, $id_products]);


    } catch (PDOException $e) {
        $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | E-commerce</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./seller/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./seller/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="hold-transition sidebar-mini">
    <?php include './components/navbars.php' ?>
    <div class="wrapper">
        <!-- Main content -->
        <div class="container-md">
            <section class="content-header">
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="col-12">
                                    <br />
                                    <img src="./upload/<?php echo $imgUrl; ?>" class="product-image">
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3"><?php echo $name; ?></h3>
                                <h5 class="my-3">รายละเอียดสินค้า</h5>
                                <p><?php echo $description; ?></p>
                                <hr>
                                <h5 class="my-3">ประเภทของสินค้า : <label><?php echo $category; ?></label></h5>
                                <p>Post: <?php echo $regdate; ?></p>
                                <div class="bg-green py-2 px-3 mt-4" rows="4">
                                    <h2 class="mb-0">
                                        <h2>ราคา <?php echo $price; ?> บาท</h2>

                                    </h2>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <?php include './seller/components/shopproduct.php' ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

    </div>
    <!-- jQuery -->
    <script src="./seller/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./seller/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./seller/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./seller/dist/js/demo.js"></script>

</body>

</html>