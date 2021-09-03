<?php 
    include_once('functions.php');
    $emailcheck = new DB_con();
    
    $email = $_POST['email'];
    $sql = $emailcheck->emailavailable($email);
    $num = mysqli_num_rows($sql);

    if ($num > 0) {
        echo "<span style='color: red; '>Email already associated with anonther account...</span>'";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color: green; '>Email already associated with anonther account...</span>'";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    }

?>