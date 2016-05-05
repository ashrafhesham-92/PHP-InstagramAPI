<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 5/4/2016
 * Time: 9:05 AM
 */

require 'config.php';
require 'instagram_service.php';

$instagram_service = new InstagramService(CLIENT_ID, CLIENT_SECRET, REDIRECT_URI);
$scopes = array('basic','public_content','likes','comments','follower_list','relationships');
$login_url = $instagram_service->getLoginURL($scopes);

header("Location:$login_url");
?>