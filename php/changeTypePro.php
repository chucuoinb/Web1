<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/11/2017
 * Time: 11:18 AM
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
$id = getValue(PRO_ID,INT,0,POST);
if (changeTypePro($id))
    ResponseMessage(CODE_OK,"",null);
else
    ResponseMessage(CODE_ERROR,"Lỗi",null);