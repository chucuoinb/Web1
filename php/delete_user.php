<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/25/2017
 * Time: 4:33 PM
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
$id_admin = getValue(USE_ID, INT, 0, SESSION);
$role_admin = getValue(USE_ROLE, INT, 0, SESSION);
$role = getValue(USE_ROLE, INT, 0, POST);
$id = getValue(USE_ID, INT, 0, POST);
if ($id == $id_admin) {
    ResponseMessage(CODE_FAIL, "Bạn không thể xóa chính mình", null);
} else {
    if ($role_admin > $role) {
        if (deleteUser($id))
            ResponseMessage(CODE_OK, "Xóa thành công", null);
        else
            ResponseMessage(CODE_FAIL,"Xóa thất bại",null);
    }
    else
        ResponseMessage(CODE_FAIL,"Bạn không có quyền xóa người này",null);
}