<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/19/2017
 * Time: 1:10 PM
 */
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
include($_SERVER['DOCUMENT_ROOT']."/function/function.php");
//$operation = new Operation();
$username = getValue(USE_USERNAME, STRING, "", POST);
$fullname = getValue(USE_FULLNAME, STRING, "", POST);
$email = getValue(USE_EMAIL, STRING, "", POST);
$birthday = getValue(USE_BIRTHDAY, STRING, "", POST);
$gender = getValue(USE_GENDER, INT, 0, POST);
$address = getValue(USE_ADDRESS, STRING, "", POST);
$phone_number = getValue(USE_PHONE_NUMBER, STRING, "", POST);
$description = getValue(USE_DESCRIPTION, STRING, "", POST);
$password = (getValue(USE_PASSWORD, STRING, "", POST));
$role = getValue("use_role",INT,0,POST);
if (validateBirthday($birthday) && validatePhone($phone_number)
    && validateEmail($email) && validateGender($gender)
    && validateValues($username) && validateValues($password)) {
    $time_register = new DateTime("now",new DateTimeZone("Asia/Ho_Chi_Minh"));
    $timestamp = $time_register->getTimestamp();
//    $time_register->format("H:i:s, d/m/Y");
    $avatar = uploadAvatar($timestamp,USE_AVATAR,$_SERVER['DOCUMENT_ROOT']."/uploads/");
    if ($avatar) {

        if (!isExistUsername($username, $email)) {
            if (storeUser($fullname, $username, $email,
                $birthday, $gender, $address, md5($password), $phone_number, $description,
                $avatar,$time_register->format("H:i:s, d/m/Y"),$role))
                echo ResponseMessage(CODE_OK,"success",null);
            else echo ResponseMessage(CODE_FAIL,"failure",null);
        } else
            echo ResponseMessage(CODE_ERROR, "username or email exist",null);


    } else
        echo ResponseMessage(CODE_ERROR,"upload avatar failure",null);
}else
    echo "Dữ liệu lỗi";
?>
