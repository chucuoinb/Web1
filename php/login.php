<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/22/2017
 * Time: 9:08 AM
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
$login = getValue("use_login", STRING, "", POST);
$password = getValue(USE_PASSWORD, STRING, "", POST);
if (validateValues($password) && (validateEmail($login) || validateValues($login))) {
    $res = login($login, md5($password));
    if ($res) {
        $_SESSION[USE_ID] = $res[USE_ID];
        $_SESSION[USE_AVATAR] = $res[USE_AVATAR];
        $_SESSION[USE_USERNAME] = $res[USE_USERNAME];
        $_SESSION[USE_FULLNAME] = $res[USE_FULLNAME];
        $_SESSION[USE_ROLE] = $res[USE_ROLE];
        if ($_POST["use_isSave"] == 1) {
            setcookie(USE_FULLNAME, $res[USE_FULLNAME], time() + 3600, "/admin");
            setcookie(USE_USERNAME, $res[USE_USERNAME], time() + 3600, "/admin");
            setcookie("save", 1, time() + 3600,"/admin");
            setcookie(USE_ROLE,$res[USE_ROLE],time()+3600,"/admin");
            setcookie(USE_AVATAR,$res[USE_AVATAR],time()+3600,"/admin");
            setcookie(USE_ID,$res[USE_ID],time()+3600,"/admin");
        }
//        echo getValue(FULLNAME,STRING,"1",COOKIE);
        echo ResponseMessage(CODE_OK, "success", $res);
    } else
        echo ResponseMessage(CODE_FAIL, "failure", null);
} else
    ResponseMessage(CODE_ERROR, "error", null);
?>