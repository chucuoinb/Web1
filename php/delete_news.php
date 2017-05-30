<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/19/2017
 * Time: 9:50 AM
 */
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
$new_id = getValue(NEW_ID,INT,0,POST);
if (deleteNews($new_id))
    ResponseMessage(CODE_OK,"",null);
else
    ResponseMessage(CODE_ERROR,"Có lỗi xảy ra, vui lòng thử lại",null);