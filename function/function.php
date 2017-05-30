<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/20/2017
 * Time: 4:25 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/class/db_loader.php");
//function connect()
//{
//    $db = DbLoader::getInstance();
//    $mysqli = $db->getConnection();
//    if (!$mysqli) {
//        die("Connection failed: " . mysqli_connect_error());
////        return fals
//    } else {
//        return $mysqli;
//    }
//}

function fnQuery($sql)
{
    $db = DbLoader::getInstance();
    if (!$db->getConnection()) {
        die("Connection failed: " . mysqli_connect_error());
        return false;
    } else {
        $res = $db->query($sql);
        return $res;
    }
}

function createRandomString($length)
{
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}

function uploadAvatar($time, $name_file, $target_dir)
{
    $uploadOk = 1;
    $imageFileType = pathinfo($_FILES["$name_file"]["name"], PATHINFO_EXTENSION);
    $name = createRandomString(3) . $time . "." . $imageFileType;
    $target_file = $target_dir . basename($name);

    if (file_exists($target_file)) {
//        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($_FILES["$name_file"]["size"] > 1024 * 1024) {
//        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
//        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
//        echo "Sorry, your file was not uploaded.";
        return false;
    } else {
        if (move_uploaded_file($_FILES["$name_file"]["tmp_name"], $target_file)) {
//                echo "The file " . basename($name) . " has been uploaded.";
            resize_image($target_dir, 100, 100, $name);
            resize_image($target_dir, 150, 150, $name);
            return $name;
        } else {

//                echo "Sorry, there was an error uploading your file.";
            return false;

        }
    }
}

function resize_image($dir, $new_width, $new_height, $name)
{
    $name_file = $dir . $name;
    $image_info = getimagesize($name_file);
    $type = $image_info[2];
    $new_image = imagecreatetruecolor($new_width, $new_height);
    if ($type == IMAGETYPE_JPEG) {

        $image = imagecreatefromjpeg($name_file);
    } elseif ($type == IMAGETYPE_GIF) {

        $image = imagecreatefromgif($name_file);
    } elseif ($type == IMAGETYPE_PNG) {
        $image = imagecreatefrompng($name_file);
        $background = imagecolorallocate($new_image, 0, 0, 0);
        // remove the black
        imagecolortransparent($new_image, $background);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
    }
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, imagesx($image), imagesy($image));
    if (!file_exists($dir . $new_width . "x" . $new_height) && !is_dir($dir . $new_width . "x" . $new_height)) {
        mkdir($dir . $new_width . "x" . $new_height);
    }
    $new_name = $dir . $new_width . "x" . $new_height . "/" . $name;
    if ($type == IMAGETYPE_JPEG) {
        imagejpeg($new_image, $new_name);
    } elseif ($type == IMAGETYPE_GIF) {
        imagegif($new_image, $new_name);
    } elseif ($type == IMAGETYPE_PNG) {
        imagepng($new_image, $new_name);
    }

}

function getInfoUsername($id)
{
    $data = array();
    $sql = "SELECT * 
            FROM users 
            WHERE use_id = '" . $id . "'";
    $res = fnQuery($sql);
    if ($res) {
        $data = mysqli_fetch_assoc($res);
        return $data;
    } else return false;
}

function ResponseMessage($code, $message, $data)
{
    $response = array();
    $response[CODE] = $code;
    $response[MESSAGE] = $message;
    $response[DATA] = $data;
    echo json_encode($response);
}

function getValue($field, $type, $default, $method)
{
    $values = $default;
    $data = $default;
    switch ($method) {
        case POST:
            $data = isset($_POST[$field]) ? $_POST[$field] : $default;
            break;
        case GET:
            $data = isset($_GET[$field]) ? $_GET[$field] : $default;
            break;
        case COOKIE:
            $data = isset($_COOKIE[$field]) ? $_COOKIE[$field] : $default;
            break;
        case SESSION:
            $data = isset($_SESSION[$field]) ? $_SESSION[$field] : $default;
            break;
    }
    switch ($type) {
        case STRING:
            if (is_string($data)) {

//                $values = preg_replace('/\s+/', '', $data);
                $values = $data;
            }
            break;
        case INT:
            if (is_int($data))
                $values = $data;
            else $values = (int)$data;
            break;
        case _ARRAY:
            if (is_array($data)) {
                $values = array();
                $values = $data;
            }
            break;
    }
    return $values;
}

function getData($type, $values)
{

    switch ($type) {
        case STRING:
            if (is_string($values))
                $data = $values;
            break;
        case INT:
            if (is_int($values))
                $data = $values;
            break;
        case _ARRAY:
            if (is_array($values)) {
                $values = array();
                $data = $values;
            }
            break;
    }
}

function isExistUsername($username, $email)
{
    $sql = "SELECT * FROM users
                WHERE use_username = '" . $username . "'
                OR use_email = '" . $email . "'";
//        $sql = "INSERT INTO users
//                (use_username,use_email)
//                  VALUES ('$username','$email')";
//    $mysqli = connect();
    $res = fnQuery($sql);
//        echo json_encode($res);
    if (mysqli_num_rows($res) > 0) {
        return true;
    } else
        return false;
}

function storeUser($fullname, $username, $email, $birthday, $gender, $address, $password, $phone_number, $description, $avatar, $time_register, $role)
{

    if (!isExistUsername($username, $email)) {
        $sql = "INSERT INTO users
                    (use_fullname,use_username,use_email,use_birthday,
                    use_gender,use_address,use_password,use_phone_number,use_description,use_avatar,use_time_create,use_active,use_role)
                    VALUES ('" . $fullname . " ',' " . $username . "',
                            '" . $email . "','" . $birthday . "',
                            '" . $gender . "','" . $address . "',
                            '" . $password . "','" . $phone_number . "','" . $description . "','" . $avatar . "',
                            '" . $time_register . "','0','" . $role . "')";
//        $mysqli = connect();
//        $stmt = $mysqli->prepare($sql);
//        $stmt->bind_param("ssssisssss",$fullname, $username, $email, $birthday, $gender, $address, $password, $phone_number, $description,$avatar);
//        $res = $stmt ->execute();
//        $stmt->close();
        $res = fnQuery($sql);
//        $mysqli->close();
        if ($res) {
            if (isExistUsername($username, $email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }

}


function transparent_background($filename)
{
    $new_name = "../uploads/123.png";
    $img = imagecreatefrompng($filename); //or whatever loading function you need
    $colors = explode(',', '255,255,255');
    $remove = imagecolorallocate($img, $colors[0], $colors[1], $colors[2]);
    imagecolortransparent($img, $remove);
    imagepng($img, $new_name);
}

function validateLen($validate)
{
    if (strlen($validate) < 8 || strlen($validate) > 20)
        return false;
    return true;
}

function checkWordSpecial($values)
{
    $filter = "/^([0-9a-zA-Z | _])+$/";
    return preg_match($filter, $values);
}

function validateValues($values)
{
    if (validateLen($values)) {
        if (checkWordSpecial($values))
            return true;
        return false;
    }
    return false;
}

function validateEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

function validatePhone($phone)
{
    $filter = array();
    array_push($filter, "/^09[0-8]{1}[0-9]{7}$/");
    array_push($filter, "/^016[3-9]{1}[0-9]{7}$/");
    array_push($filter, "/^012[0-9]{1}[0-9]{6}$/");
    array_push($filter, "/^099[3-6]{1}[0-9]{6}$/");
    array_push($filter, "/^01(88|99)[0-9]{6}$/");
    foreach ($filter as $temp) {
        if (preg_match($temp, $phone)) {
            return true;

        }
    }
    return false;
}

function validateBirthday($birthday)
{
    $date = explode("/", $birthday);
    return checkdate($date[1], $date[0], $date[2]);
}

function validateGender($gender)
{
    if ($gender == GENDER_MALE || $gender == GENDER_FEMALE)
        return true;
    return false;
}

function login($email, $password)
{
    $sql = "SELECT * FROM users
            WHERE use_password = '" . $password . "'
            AND 
            (use_email = '" . $email . "'
            OR use_username = '" . $email . "')
            ";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $values = mysqli_fetch_assoc($res);
        $list = array();
        $list[USE_EMAIL] = $values[USE_EMAIL];
        $list[USE_FULLNAME] = $values[USE_FULLNAME];
        $list[USE_ID] = $values[USE_ID];
        $list[USE_AVATAR] = $values[USE_AVATAR];
        $list[USE_USERNAME] = $values[USE_USERNAME];
        $list[USE_ROLE] = $values[USE_ROLE];
        return $list;
    }
    return false;
}

function getAllUsername()
{
    $list = array();
    $sql = "SELECT * FROM users";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $list[] = $temp;
        }
        return $list;
    } else
        return false;

}

function deleteUser($id)
{
    deleteAvatarUser($id);
    $sql = "delete from users
            where use_id = '" . $id . "'";
    $res = fnQuery($sql);
    if ($res) {
        return true;
    } else return false;
}

function deleteAvatarUser($id)
{
    $sql = "select use_avatar from users
            where use_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $temp = mysqli_fetch_assoc($res);
        $avatar = $temp[USE_AVATAR];
//        return $_SERVER['DOCUMENT_ROOT']."/uploads/".$avatar;
        unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $avatar);
        unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/150x150/" . $avatar);
        unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/100x100/" . $avatar);
    }
}

function activeUse($id)
{
    $active = 0;
    $sql = "select use_active
            from users
            where use_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $result = mysqli_fetch_assoc($res);
        $active = $result["use_active"];
        if ($active == 1)
            $active = 0;
        else
            $active = 1;
    }
    $sql = "update users
            set use_active = '" . $active . "'
            WHERE use_id = '" . $id . "'";
    $res = fnQuery($sql);
    if ($res)
        return true;
    else return false;
}

function activeCat($id)
{
    $active = 0;
    $sql = "select cat_active
            from categories_multi
            where cat_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $result = mysqli_fetch_assoc($res);
        $active = $result[CAT_ACTIVE];
        if ($active == 1)
            $active = 0;
        else
            $active = 1;
    }
    $sql = "update categories_multi
            set cat_active = '" . $active . "'
            WHERE cat_id = '" . $id . "'";
    $res = fnQuery($sql);
    if ($res)
        return true;
    else return false;
}

function activePro($id)
{
    $active = 0;
    $sql = "select pro_active
            from products_multi
            where pro_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $result = mysqli_fetch_assoc($res);
        $active = $result[PRO_ACTIVE];
        if ($active == 1)
            $active = 0;
        else
            $active = 1;
    }
    $sql = "update products_multi
            set pro_active = '" . $active . "'
            WHERE pro_id = '" . $id . "'";
    $res = fnQuery($sql);
    if ($res)
        return true;
    else return false;
}

function editUser($id, $address, $birthday, $description, $phone_number,
                  $role, $fullname, $last_update, $gender)
{
    $sql = "update users
            set use_address = '" . $address . "',
            use_birthday = '" . $birthday . "',
            use_description = '" . $description . "',
            use_phone_number = '" . $phone_number . "',
            use_role = '" . $role . "',
            use_fullname = '" . $fullname . "',
            use_last_update = '" . $last_update . "',
            use_gender = '" . $gender . "'
            where use_id = '" . $id . "'
            ";
    $res = fnQuery($sql);
    if ($res)
        return true;
    else return false;
}

function getAvatarById($id)
{
    $sql = "select use_avatar
            from users
            where use_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $temp = mysqli_fetch_assoc($res);
        return $temp[USE_AVATAR];
    } else return false;
}

function updateAvatar($id, $avatar)
{
    $sql = "update users
             set use_avatar = '" . $avatar . "'
             where use_id = '" . $id . "'";
    $res = fnQuery($sql);
    if ($res)
        return true;
    else
        return false;
}

function getListCategories()
{
    $list = array();
    $sql = "select *
            from categories_multi";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $temp [CAT_NUMBER] = getNumberProductOfCart($temp[CAT_ID]);
            $list[] = $temp;
        }
        return $list;
    } else return false;
}

function getCatById($id)
{
    $sql = "select * 
            from categories_multi
             where cat_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $temp = mysqli_fetch_assoc($res);
        return $temp;
    } else
        return false;
}

function insertCat($name, $description, $rewrite)
{
    $date = new DateTime("now", new DateTimeZone("Asia/Ho_Chi_Minh"));
    $dateTime = $date->getTimestamp();
    $sql = "insert into categories_multi
            (cat_name,cat_description,cat_rewrite,cat_active,cat_create_date)
             VALUES 
             ('" . $name . "','" . $description . "','" . $rewrite . "','1','" . $dateTime . "')";
    $res = fnQuery($sql);
    if ($res) {
        if (isExistCat($name))
            return true;
        else return false;
    }
}

function isExistCat($name)
{
    $sql = "select *
            from categories_multi
            WHERE cat_name = '" . $name . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0)
        return true;
    else return false;
}

function updateCat($name, $des, $rewrite, $id)
{
    $date = new DateTime("now", new DateTimeZone("Asia/Ho_Chi_Minh"));
    $dateTime = $date->getTimestamp();
    $sql = "update categories_multi
            set 
            cat_name = '" . $name . "',
            cat_description = '" . $des . "',
            cat_rewrite = '" . $rewrite . "',
            cat_last_update = '" . $dateTime . "'
            where cat_id = '" . $id . "'";
    $res = fnQuery($sql);
    if ($res)
        return true;
    else
        return false;
}

function getNameCat($id)
{
    $sql = "select cat_name
            from categories_multi
            where cat_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $temp = mysqli_fetch_assoc($res);
        return $temp[CAT_NAME];
    } else return false;
}

function getListProduct($catId)
{
    $list = array();
    $sql = "select *
            from products_multi
            WHERE cat_id = '" . $catId . "'
            and pro_active = 1";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $list[] = $temp;
        }
    }
    return $list;
}

function getListProductByPage($catId, $page)
{

    $list = array();
    $start = ($page - 1) * (NUMBER_ROW * NUMBER_COL);
    $sql = "select *
            from products_multi
            WHERE cat_id = '" . $catId . "'
            and pro_active = 1
            order by pro_create_date desc
            limit $start," . (NUMBER_COL * NUMBER_ROW);
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $list[] = $temp;
        }
    }
    return $list;
}

function getNumberPageProduct($catId)
{
    $list = getListProduct($catId);
    return (ceil(count($list) / (NUMBER_ROW * NUMBER_COL)));
}

function getProById($id)
{
    $sql = "select * 
            from products_multi
             where pro_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $temp = mysqli_fetch_assoc($res);
        return $temp;
    } else
        return false;
}

function addProduct($cat_id, $pro_name, $pro_create_date, $pro_price, $pro_image, $pro_description,
                    $pro_active, $pro_rewrite)
{
    $sql = "insert into products_multi
            (cat_id,pro_name,pro_create_date,pro_price,pro_image,pro_description,
    pro_active,pro_rewrite)
            VALUES ('$cat_id','$pro_name','$pro_create_date','$pro_price','$pro_image','$pro_description',
    '$pro_active','$pro_rewrite')";
    $res = fnQuery($sql);
    if ($res) {
        if (isExistPro($pro_name, $pro_create_date))
            return true;
        else
            return false;
    }
}

function isExistPro($pro_name, $pro_create)
{
    $sql = "select * from products_multi
            where pro_name = '$pro_name'
            and pro_create_date = '$pro_create'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0)
        return true;
    else
        return false;
}

function editProduct($pro_id, $cat_id, $pro_name, $pro_last_update, $pro_price, $pro_description
    , $pro_rewrite)
{
    $sql = "update products_multi
            set pro_name = '" . $pro_name . "',
            pro_last_update = '" . $pro_last_update . "',
            pro_price = '" . $pro_price . "',
            pro_description = '" . $pro_description . "',
            pro_rewrite = '" . $pro_rewrite . "',
            cat_id = '" . $cat_id . "'
            where pro_id = '" . $pro_id . "'";
    $res = fnQuery($sql);
    if ($res) {
        return true;

    } else
        return false;
}

function updateProImage($pro_image, $pro_id)
{

    deleteProImage($pro_id);
    $sqlUpdate = "update products_multi
                    set pro_image = '" . $pro_image . "'
                    where pro_id = '" . $pro_id . "'";
    $res = fnQuery($sqlUpdate);
    if ($res) {

        return true;
    }
    return false;
}

function deleteProImage($pro_id)
{
    $sql = "select pro_image
            from products_multi
            where 
            pro_id = '" . $pro_id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $pro_image = mysqli_fetch_assoc($res)[PRO_IMAGE];
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/pro_image/" . $pro_image))
            unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/pro_image/" . $pro_image);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/pro_image/100x100/" . $pro_image))
            unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/pro_image/100x100/" . $pro_image);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/pro_image/150x150/" . $pro_image))
            unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/pro_image/150x150/" . $pro_image);
    }
}

function deletePro($pro_id)
{
    deleteProImage($pro_id);
    $sql = "delete from products_multi
            where pro_id = '" . $pro_id . "'";
    $res = fnQuery($sql);
    if ($res) {
        return true;

    } else return false;
}

function deleteCat($cat_id)
{
    $sql = "delete from categories_multi
            where cat_id = '" . $cat_id . "'";
    $res = fnQuery($sql);
    if ($res) {
        return true;

    } else return false;
}

function getAllProduct()
{
    $list = array();
    $sql = "select *
            from products_multi 
            where pro_active = 1 
            ORDER by pro_name ASC";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $list[] = $temp;
        }
        return $list;
    } else
        return false;
}

function getAllProductAdmin()
{
    $list = array();
    $sql = "select *
            from products_multi 
            ORDER by pro_name ASC";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $list[] = $temp;
        }
        return $list;
    } else
        return false;
}

function createRewrite($str)
{

    $unicode = array(

        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

        'd' => 'đ',

        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

        'i' => 'í|ì|ỉ|ĩ|ị',

        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

        'D' => 'Đ',

        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

    );

    foreach ($unicode as $key => $values) {

        $str = preg_replace("/($values)/i", $key, $str);

    }
    $str = str_replace(' ', '-', $str);

    return strtolower($str);

}

function getProductHot()
{
    $list = array();
    $sql = "select *
            from products_multi where pro_hot = 1 ORDER by pro_name ASC";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $list[] = $temp;
        }
        return $list;
    } else
        return false;
}

function getNumberProductOfCart($id)
{
    $sql = "select * from products_multi
            where cat_id = '" . $id . "'
            and pro_active = 1";
    $res = fnQuery($sql);
    if ($res)
        return mysqli_num_rows($res);
    else
        return
            false;
}

function changeTypePro($id)
{
    $pro_hot = 0;
    $sql = "select pro_hot
            from products_multi
            where pro_id = '" . $id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $pro_hot = mysqli_fetch_assoc($res)[PRO_HOT];
    }
    if ($pro_hot == 0)
        $pro_hot = 1;
    else
        $pro_hot = 0;
    $sql = "update products_multi
            set pro_hot = '" . $pro_hot . "'
            where pro_id = '" . $id . "'";
    return fnQuery($sql);

}

function getHotNew($count)
{
    $list = array();
    $sql = 'select * from ' . PRO_TABLE . '
            WHERE ' . PRO_HOT . ' = 1
            ORDER by ' . PRO_CREATE_DATE . ' desc
            limit ' . $count;
    $res = fnQuery($sql);
    if ($res) {
        while ($item = mysqli_fetch_assoc($res)) {
            $list[] = $item;
        }
    }
    return $list;
}

function getNumColOfRow($numPro, $row, $numRow)
{
    if ($row <= 0)
        return 0;
    if ($row < $numRow && $row > 0)
        return NUMBER_COL;
    else
        return $numPro - ($row - 1) * NUMBER_COL;
}

function searchProduct($textSearch, $page)
{
    $start = ($page - 1) * (NUMBER_COL * NUMBER_ROW);
    $end = $start + NUMBER_ROW * NUMBER_COL;
    $list = array();

    $sql = 'select * from products_multi
            where pro_rewrite like "%' . $textSearch . '%"';
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res))
            $list[] = $temp;
    }
    $listWord =  str_replace('-', '|', $textSearch);
    $sql = 'select * from products_multi
            where pro_rewrite regexp "' . $listWord . '"';
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res))
            if (!in_array($temp, $list))
                $list[] = $temp;
    }
    $listRes = array();
    for ($i = 0; $i < count($list); $i++) {
        if ($i >= $start && $i < $end)
            $listRes[] = $list[$i];
    }
    return $listRes;
}

function getNumberPageSearch($textSearch)
{
    $list = array();

    $sql = 'select * from products_multi
            where pro_rewrite like "%' . $textSearch . '%"';
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res))
            $list[] = $temp;
    }
    $listWord = $str = str_replace('-', '|', $textSearch);
    $sql = 'select * from products_multi
            where pro_rewrite regexp "' . $listWord . '"';
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res))
            if (!in_array($temp, $list))
                $list[] = $temp;
    }
    return ceil(count($list) / (NUMBER_COL * NUMBER_ROW));
}

function getAllNews()
{
    $list = array();
    $sql = 'select * from news
            ';
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $list[] = $temp;
        }
    }
    return $list;
}

function getAllTagsNew($new_id)
{
    $list = array();
    $sql = 'select * from tag_new
            where new_id =' . $new_id;
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $item = array();
            $tag_id = $temp[TAG_ID];
            $tag_name = getNameTag($tag_id);
            $item[TAG_ID] = $tag_id;
            $item[TAG_NAME] = $tag_name;
            $list[] = $item;
        }
    }
    return $list;
}

function deleteNews($new_id)
{
    if (deleteTagNew($new_id)) {
        $ava = getAvataNews($new_id);
        $sql = 'delete from news
                where new_id = ' . $new_id;
        if (fnQuery($sql)) {
            if ($ava) {
                deleteAvaNews($ava);
            }
            return true;
        }

    } else return false;
}

function getAvataNews($new_id)
{
    $sql = 'select new_image
            from news
            where new_id = ' . $new_id;
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0)
        return mysqli_fetch_assoc($res)[NEW_IMAGE];
    else
        return false;
}


function deleteAvaNews($ava)
{

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/news/" . $ava))
        unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/news/" . $ava);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/news/100x100/" . $ava))
        unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/news/100x100/" . $ava);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/news/150x150/" . $ava))
        unlink($_SERVER['DOCUMENT_ROOT'] . "/uploads/news/150x150/" . $ava);
}

function deleteTagNew($new_id)
{
    $sql = 'delete from tag_new
            where new_id = ' . $new_id;
    return fnQuery($sql);
}

function activeNews($new_id)
{
    $active = 1;
    $sql = 'select new_active
            from news
            where new_id = ' . $new_id;
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        $active = mysqli_fetch_assoc($res)[NEW_ACTIVE];
    }
    $active = ($active == 1) ? 0 : 1;
    $sql = 'update news 
            set new_active = ' . $active . '
            where new_id = ' . $new_id;
    return fnQuery($sql);
}

function storeNews($new_title, $new_description, $new_content, $new_image, $new_tag)
{
    $time_create = time();
    $sql = "insert into news
            (new_title,new_description,new_time_create,new_active,new_content,new_image)
            VALUES 
            ('" . $new_title . "','" . $new_description . "','" . $time_create . "',1,'" . $new_content . "','" . $new_image . "')";
    if (fnQuery($sql)) {
        $new_id = isExistNews($time_create, $new_title);
        if ($new_id) {
            for ($i = 0; $i < count($new_tag); $i++) {
                $tag_id = getIdTag($new_tag[$i]);
                insertNewTag($tag_id, $new_id);
            }
            return true;
        }
    } else
        return
            false;
}

function isExistTagNew($tag_id, $new_id)
{
    $sql = "select * from tag_new
            WHERE tag_id = '" . $tag_id . "'
            and new_id = '" . $new_id . "'";
    return mysqli_num_rows(fnQuery($sql));
}

function insertNewTag($tag_id, $new_id)
{
    if (!isExistTagNew($tag_id, $new_id)) {

        $sql = "insert into tag_new
            (tag_id,new_id)
            VALUES 
            ('" . $tag_id . "','" . $new_id . "')";
        return fnQuery($sql);
    } else
        return true;
}

function insertTag($tag_name)
{
    $sql = 'insert into tags
            (tag_name)
            VALUES 
            ("' . $tag_name . '")';
    fnQuery($sql);
    return getIdTag($tag_name);
}

function getIdTag($tag_name)
{
    $sql = "select *
            from tags
            where tag_name = '" . $tag_name . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res)[TAG_ID];
    } else
        return insertTag($tag_name);
}

function isExistNews($time_create, $title)
{
    $sql = "select *
            from news
            where new_time_create = '" . $time_create . "'
            and new_title = '" . $title . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res)[NEW_ID];
    } else
        return false;
}

function getNewById($new_id)
{
    $sql = 'select * from news
            where new_id = ' . $new_id;
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0)
        return mysqli_fetch_assoc($res);
    else
        return false;
}

function updateNews($new_id, $new_title, $new_description, $new_content, $new_tag, $last_update)
{
    $sql = "update news set 
            new_title = '" . $new_title . "',
            new_content = '" . $new_content . "',
            new_description = '" . $new_description . "',
            new_last_update = '" . $last_update . "'
            where new_id = '" . $new_id . "'";
    if (fnQuery($sql)) {
        updateTag($new_id, $new_tag);
        return true;
    } else
        return false;
}

function updateTag($new_id, $tags)
{
    $listTagNew = array();
    foreach ($tags as $tag) {
        $item = getIdTag($tag);
        if ($item)
            $listTagNew[] = $item;
    }
    $listTagOld = array();
    $sql = "select tag_id
            from tag_new
            where new_id = '" . $new_id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res))
            $listTagOld[] = $temp;
    }
    foreach ($listTagOld as $tag) {
        $index = array_search($tag[TAG_ID], $listTagNew);
        if (is_int($index))
            unset($listTagNew[$index]);
        else
            deleteTagsNews($tag[TAG_ID], $new_id);
    }
    if (count($listTagNew) > 0) {
        foreach ($listTagNew as $key => $value) {
            insertTagNews($new_id, $value);
        }
    }
}

function insertTagNews($new_id, $tag_id)
{
    $sql = "insert into tag_new
            (tag_id,new_id)
            VALUES 
            ('" . $tag_id . "','" . $new_id . "')";
    fnQuery($sql);
}

function deleteTagsNews($tag_id, $new_id)
{
    $sql = "delete from tag_new
            where tag_id = '" . $tag_id . "'
            and new_id = '" . $new_id . "'";
    fnQuery($sql);
}

function updateAvaNews($new_id, $new_image)
{
    $sql = "update news set
            new_image = '" . $new_image . "'
            where new_id = '" . $new_id . "'";
    fnQuery($sql);
}

function getNameTag($id)
{
    $sql = 'select tag_name
            from tags
            where tag_id = ' . $id;
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res)[TAG_NAME];
    } else return false;
}

function getNewsByTag($tag_id)
{
    $list_new = array();
    $sql = "select * from tag_new
            where tag_id = '" . $tag_id . "'";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res)) {
            $new_id = $temp[NEW_ID];
            $news = getNewById($new_id);
            if ($news)
                $list_new[] = $news;
        }
    }
    return $list_new;
}

function getListTag()
{
    $list = array();
    $sql = "select * from tags
            ";
    $res = fnQuery($sql);
    if (mysqli_num_rows($res) > 0) {
        while ($temp = mysqli_fetch_assoc($res))
            $list[] = $temp;
    }
    return $list;
}

function editTags($tagId, $tagName)
{
    if (isExistTag($tagId)) {

        $sql = "update tags set
            tag_name = '" . $tagName . "'
            where tag_id = '" . $tagId . "'";
        return fnQuery($sql);
    }
    else
        return false;
}

function isExistTag($tagId)
{
    $sql = "select * from tags
            where tag_id = '" . $tagId . "'";
    return mysqli_num_rows(fnQuery($sql)) > 0;
}
function deleteTags($tagId){
    if (isExistTag($tagId)){
        $sql = "delete from tags
                WHERE tag_id = '".$tagId."'";
        return fnQuery($sql);
    }
    else
        return true;
}