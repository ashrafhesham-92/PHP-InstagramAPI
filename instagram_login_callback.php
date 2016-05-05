<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 5/4/2016
 * Time: 9:16 AM
 */

require 'config.php';

// check if user declined authentication
if(isset($_GET['error']) && !empty($_GET['error']))
{
    $error = $_GET['error_description'];
    echo "<h5>$error</h5>";exit;
}

// check authentication code after user approve
if(isset($_GET['code']) && !empty($_GET['code']))
{

    $params = array('client_id'=>CLIENT_ID, 'client_secret'=>CLIENT_SECRET, 'grant_type'=>'authorization_code', 'redirect_uri'=>REDIRECT_URI, 'code'=>$_GET['code']);
    $query_string = http_build_query($params);

    // make call for user access token
    $ch  = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/oauth/access_token");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    // check if API call returned error
    if($response === false)
    {
        echo "CURL ERROR: " . curl_error($ch);exit;
    }

    // log response object if API call returned successfully
    $response_obj = json_decode($response);
//    var_dump($response_obj);
    curl_close($ch);

    $access_token = $response_obj->access_token;

    // store the access token into the session
    $_SESSION['instagram_accesstoken'] = $access_token;

    echo "Get User Information: <a href='get_user_info.php'>User Info</a><p/>";
}
else
{
    die('authentication error');
}
?>