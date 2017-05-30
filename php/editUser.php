<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/8/2017
 * Time: 11:53 AM
 */
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
include($_SERVER['DOCUMENT_ROOT']."/function/function.php");
//$operation = new Operation();
$fullname = getValue(USE_FULLNAME, STRING, "", POST);
$birthday = getValue(USE_BIRTHDAY, STRING, "", POST);
$gender = getValue(USE_GENDER, INT, 0, POST);
$address = getValue(USE_ADDRESS, STRING, "", POST);
$phone_number = getValue(USE_PHONE_NUMBER, STRING, "", POST);
$description = getValue(USE_DESCRIPTION, STRING, "", POST);
$role = getValue(USE_ROLE,INT,0,POST);
$id = getValue(USE_ID,INT,0,POST);
$time_register = new DateTime("now",new DateTimeZone("Asia/Ho_Chi_Minh"));
$last_update = $time_register->getTimestamp();
$res = editUser($id, $address, $birthday, $description, $phone_number,
    $role, $fullname, $last_update, $gender);
if ($res){
    if (isset($_FILES[USE_AVATAR])){
       $up = uploadAvatar($last_update,USE_AVATAR,$_SERVER['DOCUMENT_ROOT']."/uploads/");
        if ($up){
        deleteAvatarUser($id);
        }
    }
         ResponseMessage(CODE_OK,"ok",null);
}else
    ResponseMessage(CODE_FAIL,"ok2",null);