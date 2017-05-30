<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/29/2017
 * Time: 9:32 AM
 */
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
$tagId = getValue(TAG_ID,INT,0,POST);
$listNew = getNewsByTag($tagId);
if (count($listNew)>0){
    ResponseMessage(CODE_FAIL,"Tag vẫn còn sử dụng",null);
}
else{
    if (deleteTags($tagId))
        ResponseMessage(CODE_OK,"",null);
    else
        ResponseMessage(CODE_FAIL,"Xóa thất bại, vui lòng thử lại sau",null);
}
