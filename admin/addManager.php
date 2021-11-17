<?php
require_once('../connection.php');
session_start();
 error_reporting(0);

if (!$_SESSION['id_admin'] ) {
    header("location: loginAdmin.php");
} else {

    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        if (empty($firstname)) {
            $errorMsg = "Please Enter firstname ";
        } elseif (empty($lastname)) {
            $errorMsg = "Please Enter lastname";
        } elseif (empty($email)) {
            $errorMsg = "Please Enter email";
        } elseif (empty($password)) {
            $errorMsg = "Please Enter password";
        }

        if (!isset($errorMsg)) {
            $sql = "INSERT INTO managers (firstname, lastname, email, password ) VALUES (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$firstname, $lastname, $email, $password]);
            if ($sql) {
                echo "<script>alert('Cearte Successfull')</script>";
                echo "<script>window.location.href='../admin/editmanagers.php'</script>";
            } else {
                echo "<script>alert('Something went wrong! Please try again...')</script>";
                echo "<script>window.location.href='../admin/addManager.php'</script>";
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
        <title>Create Manager</title>
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
                                <h1 class="m-0">Create Manager Page</h1>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Craete Manager</h3>
                                            </h3>
                                        </div>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="firstname">first name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">last name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="form-group">
                                            <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary ">Create Product</button>
                                                <a href="editmanagers.php" class="btn btn-danger">back to manager</a>
                                            </div>
                                        </div>
                                        <div class="container text-center">
                                            <?php
                                            if (isset($errorMsg)) {
                                            ?>
                                                <div class="alert alert-danger">
                                                    <strong><?php echo $errorMsg; ?></strong>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if (isset($insertMsg)) {
                                            ?>
                                                <div class="alert alert-success">
                                                    <strong><?php echo $insertMsg; ?></strong>
                                                </div>
                                            <?php } ?>
                                    </form>
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>

    </body>

    </html>

<?php
}
?>