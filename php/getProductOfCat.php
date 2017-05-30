<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/15/2017
 * Time: 10:01 AM
 */
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
if (isset($_POST[CAT_ID])){
    $catId = getValue(CAT_ID,INT,0,POST);
    $list = getListProduct($catId);
    ResponseMessage(CODE_OK,"",$list);
}