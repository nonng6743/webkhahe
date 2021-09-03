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
if ($num > 0){
    echo "<script>alert('มีร้านค้าอยู่ในบัญชีเเล้ว')</script>";
    echo "<script>window.location.href='dashboardseller.php'</script>";

} else {


    if (isset($_POST['submit'])) {
        $id_area = $_POST['id_area'];
        $nameshop = $_POST['nameshop'];
        $lat = ($_POST['lat']);
        $lon = $_POST['lon'];


        $sql = $userdata->createshop($id_seller, $id_area, $nameshop, $lat, $lon);
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
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">สร้างร้านค้า </h1>

        <hr>
        <form method="POST">
            <div class="mb-3">
                <label for="id_area" class="form-label">area</label>
                <input type="text" class="form-control" id='id_area' name="id_area">
            </div>
            <div class="mb-3">
                <label for="nameshop" class="form-label">ชื่อร้าน</label>
                <input type="text" class="form-control" id='nameshop' name="nameshop">
            </div>
            <div class="mb-3">
                <label for="lat" class="form-label">lat</label>
                <input type="text" class="form-control" id='lat' name="lat">
            </div>
            <div class="mb-3">
                <label for="lon" class="form-label">lon</label>
                <input type="text" class="form-control" id='lon' name="lon">
            </div>
            <button type="submit" name="submit" class="btn btn-success">สร้างร้านค้า</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>