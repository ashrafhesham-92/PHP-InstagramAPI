<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 5/4/2016
 * Time: 10:12 AM
 */

require 'config.php';
require 'instagram_api_calls.php';

// instantiating object of InstagramAPI
$instagramAPI = new InstagramAPI(CLIENT_ID, CLIENT_SECRET);

// get your information
$user_info = $instagramAPI->getUser($_SESSION['instagram_accesstoken']);

echo "<h3>Object Containing Your Information</h3>";
var_dump($user_info);
echo "<p/>";

//// get your recent media
//recent_media = $instagramAPI->getRecentMedia($_SESSION['instagram_accesstoken'], 10);
//
//echo "<h3>Object Containing Your Recent Media</h3>";
//var_dump(recent_media);
//echo "<p/>";
//
////*** $user_recent_media->data[0]->id // this is for getting media id ***//
//

//// get a user recent media
//$user_recent_media = $instagramAPI->getUserRecentMedia($_SESSION['instagram_accesstoken'], $user_id, 10);
//
//echo "<h3>Object Containing A User's Recent Media</h3>";
//var_dump($user_recent_media);
//echo "<p/>";
//
////*** $user_recent_media->data[0]->id // this is for getting media id ***//
//
// get your media by short code
$user_media = $instagramAPI->getMediaByShortcode($_SESSION['instagram_accesstoken'], 'BAsVtKCQVp3', 'image');

echo "<h3>Object Containing Your Media Returned By ShortCode</h3>";
var_dump($user_media);
echo "<p/>";
//
// get your media by id
$user_media_by_id = $instagramAPI->getMediaByID($_SESSION['instagram_accesstoken'], "1165401865710557815_542199181", "image");

echo "<h3>Object Containing Your Media Returned By ID</h3>";
var_dump($user_media_by_id);
echo "<p/>";
//
//
//
//// get comments on specific media
//$comments = $instagramAPI->getMediaComments($_SESSION['instagram_accesstoken'], "1165401865710557815_542199181");
//
//echo "<h3>Object Containing Media Comments</h3>";
//var_dump($comments);
//echo "<p/>";
//
//// delete comment on specific media
///*$delete_comment = $instagramAPI->deleteComment($_SESSION['instagram_accesstoken'], "1165401865710557815_542199181", "17847165712121734");
//// if returned code is 200 so deletion done ok.
//
//echo "<h3>Object Containing Deleted Comment</h3>";
//var_dump($delete_comment);
//echo "<p/>";*/
//
//// result of posting a comment
///*$user_post_comment = $instagramAPI->postComment($_SESSION['instagram_accesstoken'], "1165401865710557815_542199181", "Testing comments from PHP222");
//
//echo "<h3>Object Containing Posting Comment Result</h3>";
//var_dump($user_post_comment);
//echo "<p/>";*/
//
//
//// get tag object
//$tag_info = $instagramAPI->getTagInfo($_SESSION['instagram_accesstoken'], "food");
//
//echo "<h3>Object Containing Tag Information</h3>";
//var_dump($tag_info);
//echo "<p/>";
//
//// get tag by name
//$get_tag_by_name = $instagramAPI->searchTag($_SESSION['instagram_accesstoken'], "nofilter");
//
//echo "<h3>Object Containing Tag Search Result</h3>";
//var_dump($get_tag_by_name);
//echo "<p/>";
//
//// get recently tagged media
//$get_recently_tagged_media = $instagramAPI->getRecentlyTaggedMedia($_SESSION['instagram_accesstoken'], "food", 100);
//
//echo "<h3>Object Containing Recently Tagged Media</h3>";
//var_dump($get_recently_tagged_media);
//echo "<p/>";
//
//// search media
//$search_media = $instagramAPI->searchMedia($_SESSION['instagram_accesstoken'],"30.0936695" , "31.3026881");
//
//echo "<h3>Object Containing Search Media In A Given Area Results</h3>";
//var_dump($search_media);
//echo "<p/>";
//
//// search user
//$search_user = $instagramAPI->searchUser($_SESSION['instagram_accesstoken'], 'ashrafhesham');
//
//echo "<h3>Object Containing Search User Results</h3>";
//var_dump($search_user);
//echo "<p/>";
//
//// set like
//$set_like = $instagramAPI->setLike($_SESSION['instagram_accesstoken'], "1165401865710557815_542199181");
//
//echo "<h3>Object Containing Like Set ON A Media</h3>";
//var_dump($set_like);
//echo "<p/>";
//
//
//// delete like
//$delete_like = $instagramAPI->deleteLike($_SESSION['instagram_accesstoken'], "1165401865710557815_542199181");
//
//echo "<h3>Object Containing Like Deletion Response ON A Media</h3>";
//var_dump($delete_like);
//echo "<p/>";
//
//// get follows
//$get_followed_by = $instagramAPI->getFollowedBy($_SESSION['instagram_accesstoken']);
//
//echo "<h3>Object Containing People You're Followed By</h3>";
//var_dump($get_followed_by);
//echo "<p/>";
//// get recently liked media
//$get_recently_liked_media = $instagramAPI->getRecentlyLikedMedia($_SESSION['instagram_accesstoken'], $count);
//
//echo "<h3>Object Containing Your Recently Liked Media</h3>";
//var_dump($get_recently_liked_media);
//echo "<p/>";

?>