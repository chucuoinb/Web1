<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/9/2017
 * Time: 8:45 AM
 */

require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
$list = getAllProduct();
if ($list)
    ResponseMessage(CODE_OK,"success",$list);
else ResponseMessage(CODE_FAIL,"failure",null);