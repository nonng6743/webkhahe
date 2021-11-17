<?php 
    require_once('connection.php');

    // Getting post value
    $uname = $_POST['name'];

    $select_name = $db->prepare("SELECT * FROM products WHERE nameproduct LIKE '%$uname%' ");
    $select_name->execute();
    $num = $select_name->rowCount();
    

    if ($num > 5) {
         echo "<span style='color: red;'>ชื่อสินค้านี้มีร้านค้าขายสินค้าเดียวกันจำนวนมากกว่า 5 ร้าน</span>";
    } else {
      echo "<span style='color: green;'>ชื่อสินค้านี้มีร้านค้าขายสินค้าเดียวกันจำนวนน้อย</span>";
    }
    