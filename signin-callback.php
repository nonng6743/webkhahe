<?php
require_once('connection.php');
session_start();
ini_set('display_errors', 1);
 require_once('./components/facebook-sdk-v5/autoload.php');


$fb = new Facebook\Facebook([
    'app_id' => '231959892239714',
    'app_secret' => 'f8c350ac1f149c5e4ce5ba3f05740856',
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']

  $response = $fb->get('/me?fields=id,first_name,last_name,email', $accessToken);

  $user = $response->getGraphUser();
  
  $id_facebook = $user['id'];
  $firstname = $user['first_name'];
  $lastname = $user['last_name'];
  $email = $user['email'];

  
  $select_stmt = $db->prepare("SELECT * FROM users WHERE  email = :uemail");
  $select_stmt->execute(array(':uemail' => $email));
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if ( $email == $row['email']) {
      $_SESSION['id_user'] = $row['id_user'];
      $_SESSION['firstname'] = $row['firstname'];
      $_SESSION['role'] = $row['role'];
      $_SESSION['image'] = $row['image'];
      
       $role = $row['role'];
                        
        $message = ("INSERT INTO login(typeuser) VALUES ('$role')");
        $stmt = $db->prepare($message);
        $stmt->execute();
      header("refresh:2;index.php");
    }else {
      $insert_stml = $db->prepare("INSERT INTO users (firstname,lastname,email,id_facebook,password,gender,phone) VALUES (:ufirstname, :ulastname, :uemail, :uid_facebook,'','','')");
      if ($insert_stml->execute(array(
        ':ufirstname' => $firstname,
        ':ulastname' => $lastname,
        ':uemail' => $email,
        ':uid_facebook' => $id_facebook,
        
    ))) {
         $select_stmt = $db->prepare("SELECT * FROM users WHERE  email = :uemail");
  $select_stmt->execute(array(':uemail' => $email));
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if ( $email == $row['email']) {
      $_SESSION['id_user'] = $row['id_user'];
      $_SESSION['firstname'] = $row['firstname'];
      $_SESSION['role'] = $row['role'];
      $_SESSION['image'] = $row['image'];
      
       $role = $row['role'];
      $message = ("INSERT INTO login(typeuser) VALUES ('$role')");
        $stmt = $db->prepare($message);
        $stmt->execute();
      header("refresh:2;index.php");
    }
    }
  }
  
      

  

}
