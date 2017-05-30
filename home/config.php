<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/19/2017
 * Time: 5:30 PM
 */
define("DB_HOST", "localhost:3307");
define("DB_USER", "root");
define("DB_PASSWORD","26120710");
define("DB_DATABASE", "fs_myshop");
define("TABLE_USERS","users");

//users
define("USE_ID","use_id");
define("USE_USERNAME","use_username");
define("USE_FULLNAME","use_fullname");
define("USE_EMAIL","use_email");
define("USE_PASSWORD","use_password");
define("USE_ADDRESS","use_address");
define("USE_PHONE_NUMBER","use_phone_number");
define("USE_GENDER","use_gender");
define("GENDER_MALE",0);
define("GENDER_FEMALE",1);
define("USE_BIRTHDAY","use_birthday");
define("USE_DESCRIPTION","use_description");
define("USE_AVATAR","use_avatar");
define("USE_ROLE","use_role");
define("USE_TIME_CREATE","use_time_create");
define("USE_LAST_UPDATE","use_last_update");
define("USE_ACTIVE","use_active");

//categories
define("CAT_NAME_TABLE","categories_multi");
define("CAT_ID","cat_id");
define("CAT_NAME","cat_name");
define("CAT_DESCRIPTION","cat_description");
define("CAT_REWRITE","cat_rewrite");
define("CAT_ACTIVE","cat_active");
define("CAT_CREATE_DATE","cat_create_date");
define("CAT_LAST_UPDATE","cat_last_update");
define("CAT_NUMBER","cat_number");

//product
define("PRO_ID","pro_id");
define("PRO_NAME","pro_name");
define("PRO_CREATE_DATE","pro_create_date");
define("PRO_LAST_UPDATE","pro_last_update");
define("PRO_PRICE","pro_price");
define("PRO_ACTIVE","pro_active");
define("PRO_DESCRIPTION","pro_description");
define("PRO_REWRITE","pro_rewrite");
define("PRO_IMAGE","pro_image");
define("PRO_HOT","pro_hot");
define("PRO_TABLE","products_multi");

//news
define("NEW_ID","new_id");
define("NEW_TITLE","new_title");
define("NEW_DESCRIPTION","new_description");
define("NEW_TIME_CREATE","new_time_create");
define("NEW_LAST_UPDATE","new_last_update");
define("NEW_CONTENT","new_content");
define("NEW_ACTIVE","new_active");
define("NEW_IMAGE","new_image");
define("NEW_TAG","new_tag");

define("TAG_NAME","tag_name");
define("TAG_ID","tag_id");


define("_ARRAY","array");
define("STRING","string");
define("INT","int");
define("CODE", "code");
define("TOKEN", "token");
define("MESSAGE", "message");
define("DATA", "data");
define("POST","post");
define("GET","get");
define("SESSION","session");
define("COOKIE","cookie");

//code
define("CODE_OK",200);
define("CODE_ERROR",201);
define("CODE_FAIL",202);

define("NUMBER_COL",3);
define("NUMBER_ROW",2);