<?php
include 'connected.php';
	header("Access-Control-Allow-Origin: *");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    
    exit;
}

if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
	}

if (isset($_GET)) {
	if ($_GET['isAdd'] == 'true') {
				
		
		
		$id_seller = $_GET['id_seller'];
		$detailpromotion = $_GET['detailpromotion'];
		$image = $_GET['image'];
		$status = $_GET['status'];
	
	
				
		$sql = "INSERT INTO `promotionseller`(`id_promotionseller`, `id_seller`, `detailpromotion`, `image`, `status`) VALUES (null,$id_seller,'$detailpromotion','$image','$status')";

		$result = mysqli_query($link, $sql);

		if ($result) {
			echo "true";
		} else {
			echo "false";
		}

	} else echo "###### Add Promotion Seller ####### ";
   
}
	mysqli_close($link);
?>