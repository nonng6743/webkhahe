<?php 
    error_reporting(0);
    session_start();
    $id_user = $_SESSION['id_user'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"> 
            <i class="fas fa-bars"></i>
        </label>
    <label class="logo">Kheha K.6</label>
    <ul>
        <li><a class="active" href="./index.php">Home</a></li>
        <li><a  href="../../../projectweb/admin/loginAdmin.php">สำหรับ Admin</a></li>
        <li><a  href="../../../projectweb/seller/signin.php">Seller Centre</a></li>
        <li><a  href="../../../projectweb/seller/signup.php">ขายสินค้ากับเรา</a></li>
        <?php
        if (!$id_user ){
            echo "<li><a href='./signin.php'>Login</a></li>";
            echo "<li><a href='./signup.php'>Signup</a></li>";
        } elseif ($id_user){
            echo "<li><a href='logout.php' class='btn btn-danger'>Logout</a></li>";  
        }
        ?>
        
        
    </ul>
    </nav>
</html>