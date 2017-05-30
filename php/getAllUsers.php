<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/25/2017
 * Time: 2:37 PM
 */
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
$list = getAllUsername();
if ($list)
    ResponseMessage(CODE_OK,"success",$list);
else ResponseMessage(CODE_FAIL,"failure",null);