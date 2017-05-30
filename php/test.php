<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/20/2017
 * Time: 2:16 PM
 */
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
//$id = 7;
//    $sql = "select use_avatar from users
//            where use_id = '".$id."'";
//    $res = fnQuery($sql);
//    if(mysqli_num_rows($res)>0){
//        $temp = mysqli_fetch_assoc($res);
//        $avatar = $temp[AVATAR];
////        return $_SERVER['DOCUMENT_ROOT']."/uploads/".$avatar;
//        unlink($_SERVER['DOCUMENT_ROOT']."/uploads/".$avatar);
//        unlink($_SERVER['DOCUMENT_ROOT']."/uploads/150x150/".$avatar);
//        unlink($_SERVER['DOCUMENT_ROOT']."/uploads/100x100/".$avatar);
//    }
//$time_register = new DateTime("now",new DateTimeZone("Asia/Ho_Chi_Minh"));
//$timestamp = $time_register->getTimestamp();
//uploadAvatar("12345");
//if( isset($_FILES[USE_AVATAR]))
//    echo "true";
//else
//    echo "false";
//echo getValue(USERNAME,STRING,"",SESSION);
$tag = getAllTagsNew(8);
$list = array();
foreach ($tag as $item){
    $list[] = $item[TAG_NAME];
}
 json_encode(updateTag(10,$list));
