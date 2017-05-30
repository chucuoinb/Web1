<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
$res = array();
$res["role"] = getValue(USE_ROLE, INT, 0, SESSION);
$res["id"] = getValue(USE_ID, INT, 0, SESSION);
$id = getValue(USE_ID, INT, 0, POST);
$role = getValue(USE_ID, INT, 0, POST);
//ResponseMessage(CODE_OK,"hihi",$res);
if ($role < $res["role"] || $res["id"] == $id) {

//    $url = '/admin/users/edit.php?id='.$id;
//    header('Location: '.$url);

    $r = new HttpRequest('/admin/users/edit.php', HttpRequest::METH_POST);
    $r->addPostFields(array('id' => $id));
    try {
        echo $r->send()->getBody();
    } catch (HttpException $ex) {
        echo $ex;
    }
}
else
    echo '<script type="text/javascript">alert("Bạn không có quyền chỉnh sửa người này")</script>';
?>
