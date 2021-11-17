<?php
require_once('./connection.php');
session_start();
error_reporting(0);
$id_user = $_SESSION['id_user'];

if (isset($_POST['sand'])) {
    $message = $_POST['report'];
    if(!$id_user){
        $id_user = 0;
    
        
    }

    if (empty($message)) {
        $errorMsg[] = "กรุณากรอกข้อความเพื่อเเจ้งปัญหา";
    } else {
        try {
            if (!isset($errorMsg)) {
                

                $insert_stml = $db->prepare("INSERT INTO reports (id_user,message) VALUES (:uid_user, :message)");
                if ($insert_stml->execute(array(
                    ':uid_user' => $id_user,
                    ':message' => $message,
                ))) {
                    echo "<script>alert('ส่งปัญหาที่เเจ้งให้กับผู้จัดการตลาดเรียบร้อยเเล้ว')</script>";
                    echo "<script>window.location.href='index.php'</script>";
                }
                
            }
        } catch (PDOException $e) {
            $e->getMessage();
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ตลาดเคหะคลองหก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php include './components/Navbar.php' ?>
    <br />
    <div class="container">
        <div class="alert alert-primary" role="alert">
            เเจ้งปัญหากับทางผู้จัดการตลาด
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <?php
            if (isset($errorMsg)) {
                foreach ($errorMsg as $error) {
            ?>
                    <div class="alert alert-danger">
                        <strong><?php echo $error; ?></strong>
                    </div>
            <?php
                }
            }
            ?>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">ปัญหาที่พบ หรือสามารถติดต่อทางช่องทาง Email : khahekong6support@mail.com</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="report" rows="8"></textarea>
            </div>
            <button class="btn btn-primary" type="submit" name="sand">ส่ง</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>


</html>