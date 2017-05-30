<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/27/2017
 * Time: 11:55 AM
 */
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
$role = getValue(USE_ROLE,INT,0,POST);
$admin_role = getValue(USE_ROLE,INT,0,SESSION);
$address = getValue("address",INT,0,POST);
$res = "";
if (isset($_POST[USE_ID])){
    if ($admin_role>$role){

    $id = getValue(USE_ID,INT,0,POST);
    $res = activeUse($id);
    }else
        ResponseMessage(CODE_FAIL,"Bạn không có quyền này",null);
}
else if (isset($_POST[CAT_ID]) ){
    if ($admin_role>=1) {
    $id = getValue(CAT_ID,INT,0,POST);
    $res = activeCat($id);
    }else
        ResponseMessage(CODE_FAIL,"Bạn không có quyền này",null);
} else if (isset($_POST[PRO_ID]) ){
    if ($admin_role>=1) {
    $id = getValue(PRO_ID,INT,0,POST);
    $res = activePro($id);
    }else
        ResponseMessage(CODE_FAIL,"Bạn không có quyền này",null);
}
else if (isset($_POST[NEW_ID])){
    $id = getValue(NEW_ID,INT,0,POST);
    $res = activeNews($id);
}
if($res)
    echo ResponseMessage(CODE_OK,"success",null);
else
    echo ResponseMessage(CODE_FAIL,"failure",null);
