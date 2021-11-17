<?php 

    include_once('../functions.php');

    $usernamecheck = new DB_con();

    // Getting post value
    $uemail = $_POST['email'];

    $sql = $usernamecheck->emailavailable($uemail);

    $num = mysqli_num_rows($sql);

    if ($num > 0) {
        echo "<span style='color: red;'>Email already associated with another account.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color: green;'>Email available for registration.</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }

?>