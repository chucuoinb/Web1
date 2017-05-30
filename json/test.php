<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/18/2017
 * Time: 9:39 AM
 */
$fp = @fopen('item.json', "r");

// Kiểm tra file mở thành công không
if (!$fp) {
    echo 'Mở file không thành công';
}
else
{
    // Đọc file và trả về nội dung
    $data = fread($fp, filesize('item.json'));
    echo $data;
}