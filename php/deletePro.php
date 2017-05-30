<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/8/2017
 * Time: 1:24 PM
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
$pro_id = getValue(PRO_ID,INT,0,POST);
if (deletePro($pro_id)){
    ResponseMessage(CODE_OK,"ok",$pro_id);
}
else
    ResponseMessage(CODE_FAIL,"Xóa thất bại, vui lòng thử lại",null);