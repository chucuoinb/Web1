<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/27/2017
 * Time: 2:31 PM
 */
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
$id = getValue(USE_ID,INT,0,POST);
$res = getInfoUsername($id);
if ($res){
    $birthday = $res[USE_BIRTHDAY];
    $date = explode("/",$birthday);
    $res["day"] =$date[0];
    $res["month"] = $date[1];
    $res["year"] = $date[2];
    $res["role_admin"] = getValue(USE_ROLE,INT,0,SESSION);
    ResponseMessage(CODE_OK,"success",$res);
}
else{
    ResponseMessage(CODE_ERROR,"failure",null);
}