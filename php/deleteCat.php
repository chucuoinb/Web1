<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/8/2017
 * Time: 1:55 PM
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
$cat_id = getValue(CAT_ID,INT,0,POST);
$list_pro = getListProduct($cat_id);
if ($list_pro){
    ResponseMessage(CODE_FAIL,"Bạn không thể xóa thư mục còn sản phẩm",$cat_id);

}
else{
    if (deleteCat($cat_id))
        ResponseMessage(CODE_OK,"Xóa thành công",$cat_id);
    else
        ResponseMessage(CODE_FAIL,"Xóa thất bại, vui lòng thử lại",$cat_id);
}