<?php

//start the session
session_start();

//include autoload file from vendor folder
require './vendor/autoload.php';


$fb = new Facebook\Facebook([
    'app_id' => '210336154472337', // replace your app_id
    'app_secret' => '6bc3bdc97e6fe88cd09d844c1caa06bf',   // replace your app_scsret
    'default_graph_version' => 'v2.7'
]);


$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("http://localhost/projectweb/");

try {

    $accessToken = $helper->getAccessToken();
    if (isset($accessToken)) {
        $_SESSION['access_token'] = (string) $accessToken;  //conver to string
        //if session is set we can redirect to the user to any page 
        header("Location:index.php");
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
