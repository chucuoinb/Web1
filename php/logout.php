<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/22/2017
 * Time: 10:43 PM
 */
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
setcookie(USE_FULLNAME, $res[USE_FULLNAME], time() - 3600, "/admin");
setcookie(USE_USERNAME, $res[USE_USERNAME], time() - 3600, "/admin");
setcookie("save", 1, time() - 3600,"/admin");
setcookie(USE_ROLE,$res[USE_ROLE],time()-3600,"/admin");
setcookie(USE_AVATAR,$res[USE_AVATAR],time()-3600,"/admin");
setcookie(USE_ID,$res[USE_ID],time()-3600,"/admin");
if (isset($_SESSION[USE_ID]))
    unset($_SESSION[USE_ID]);
if (isset($_SESSION[USE_FULLNAME]))
    unset($_SESSION[USE_FULLNAME]);
if (isset($_SESSION[USE_AVATAR]))
    unset($_SESSION[USE_AVATAR]);
if (isset($_SESSION[USE_ROLE]))
    unset($_SESSION[USE_ROLE]);
if (isset($_SESSION[USE_USERNAME]))
    unset($_SESSION[USE_USERNAME]);
//echo 1;
