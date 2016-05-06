<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 5/4/2016
 * Time: 9:26 AM
 */

define("CLIENT_ID","YOUR_CLIENT_ID");
define("CLIENT_SECRET","YOUR_CLIENT_SECRET");
// you can change the callback php file name in the redirect uri, but first change the name of the source file.
define("REDIRECT_URI","http://localhost/InstagramAPI/instagram_login_callback.php");
session_start();
?>