<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
$id = getValue("id", INT, 0, GET);
$admin_role = getValue(USE_ROLE,INT,0,SESSION);
$admin_id = getValue(USE_ID,INT,0,SESSION);
$res = getInfoUsername($id);
$date = explode("/",$res[USE_BIRTHDAY]);
echo '<style type="text/css">
        #input_avatar {
            display: block;
        }
        </style>';
?>
<div id="admin_edit_users">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>Edit Users</span>
    </div>
    <div id="register">
        <form id="form_edit"
              target="_blank">
            <input value="<?php echo $res[USE_ID]?>" type="text" id="input_id" class="register_input" name="use_id" hidden>
            <div>
                <p class="title_register">Edit Customers</p>

                <div id="field_name" class="field_register">
                    <p class="title_input">Họ tên: <span>*</span></p>
                    <div>
                        <input type="text" id="input_name" class="register_input" name="use_fullname" value="<?php echo $res[USE_FULLNAME]?>">
                        <i class="fa fa-check register_validate" id="register_name_true" aria-hidden="true"></i>
                    </div>

                    <span class="register_error_field" id="register_name_error"></span>

                </div>

                <div id="field_email" class="field_register">
                    <p class="title_input">Email: <span>*</span></p>
                    <div>
                        <input value="<?php echo $res[USE_EMAIL]?>" type="text" id="input_email" class="register_input" name="use_email" readonly>
                        <i class="fa fa-check register_validate" aria-hidden="true" id="register_email_true"></i>
                    </div>
                    <span class="register_error_field" id="register_email_error"></span>
                </div>

                <div id="field_username" class="field_register">
                    <p class="title_input">Tên đăng nhập: <span>*</span></p>
                    <div>
                        <input value="<?php echo $res[USE_USERNAME]?>" type="text" id="input_username" class="register_input" name="use_username" readonly>
                        <i class="fa fa-check register_validate" aria-hidden="true" id="register_username_true"></i>
                    </div>
                    <span class="register_error_field" id="register_username_error"></span>
                </div>


                <div id="field_address" class="field_register">
                    <p class="title_input">Địa chỉ: <span>*</span></p>
                    <div>
                        <input value="<?php echo $res[USE_ADDRESS]?>" type="text" id="input_address" class="register_input" name="use_address">
                        <i class="fa fa-check register_validate" aria-hidden="true" id="register_address_true"></i>
                    </div>
                    <span class="register_error_field" id="register_address_error"></span>
                </div>

                <div id="field_phone_number" class="field_register">
                    <p class="title_input">Số điện thoại: <span>*</span></p>
                    <div>
                        <input value="<?php echo $res[USE_PHONE_NUMBER]?>" type="text" id="input_phone_number" class="register_input" name="use_phone_number">
                        <i class="fa fa-check register_validate" aria-hidden="true" id="register_phone_true"></i>
                    </div>
                    <span class="register_error_field" id="register_phone_error"></span>
                </div>

                <div id="field_gender" class="field_register">
                    <p class="title_input">Giới tính: <span>*</span></p>
                    <div>
                        <input id="male" type="radio" name="use_gender" value="0" <?php if($res[USE_GENDER]==GENDER_MALE) echo "checked='checked'"?> > Nam
                        <input type="radio" name="use_gender" value="1" id="female" <?php if($res[USE_GENDER]==GENDER_FEMALE) echo "checked='checked'"?>> Nữ
                    </div>
                </div>

                <div id="field_birthday" class="field_register">
                    <p class="title_input">Ngày sinh: <span>*</span></p>
                    <div>
                        <select name="" id="day">
                            <?php
                                for ($i = 1;$i<=31;$i++){
                                    $select = "";

                                    $day = $date[0];
                                    if ($day == $i)
                                        $select = 'selected="selected"';
                                    echo '<option value="'.$i.'" id = "day'.$i.'"'.$select.'>'.$i.'</option>';
                                }
                            ?>
<!--                            <option value="1" id="day1">1</option>-->

                        </select>
                        <select name="" id="month">
                            <?php
                            for ($i = 1;$i<=12;$i++){
                                $select = "";
                                $month = $date[1];
                                if ($month == $i)
                                    $select = 'selected="selected"';
                                echo '<option value="'.$i.'" id = "month'.$i.'"'.$select.'>'.$i.'</option>';
                            }
                            ?>
                        </select>
                        <select name="" id="year">
                            <?php
                            for ($i = 1960;$i<=2017;$i++){
                                $select = "";
                                $year = $date[2];
                                if ($year == $i)
                                    $select = 'selected="selected"';
                                echo '<option value="'.$i.'" id = "year'.$i.'"'.$select.'>'.$i.'</option>';
                            }
                            ?>
                        </select>
                        <input type="text" name="use_birthday" hidden="true" id="input_birthday">
                        <p>(dd/mm/yyyy) <br></p>
                    </div>
                    <br>
                    <span class="" id="register_birthday_error"></span>
                </div>

                <div id="field_note" class="field_register">
                    <p class="title_input">Mô tả: <span>*</span></p>
                    <div>
                        <textarea id="input_note" class="register_input" name="use_description"><?php echo $res[USE_DESCRIPTION]?></textarea>
                    </div>
                    <span class="register_error_field" id="register_note_error"></span>
                </div>
                <div id="field_birthday" class="field_register">
                    <p class="title_input">Phân quyền: <span>*</span></p>
                    <div>
                        <select  name="" id="role" <?php if($admin_role <2 || $admin_id==$res[USE_ID]) echo 'disabled="disabled"'?>>
                            <option value="0" <?php if ($res[USE_ROLE] == 0) echo 'selected="selected"'?>>User thường</option>
                            <option value="1" <?php if ($res[USE_ROLE] == 1) echo 'selected="selected"'?>>Admin</option>
                            <option value="2" <?php if ($res[USE_ROLE] == 2) echo 'selected="selected"'?>>Super Admin</option>
                        </select>
                    </div>
                    <br>
                    <span class="register_error_field" id="role_error"></span>
                </div>
                <div id="field_avatar" class="field_register">
                    <p class="title_input">Ảnh đại diện: <span>*</span></p>
                    <div>
                        <div id="input_avatar">
                            <img id="img_avatar" alt="" src="<?php echo '/uploads/'.$res[USE_AVATAR] ?>">
                        </div>

                        <input type="file" value="123" id="bt_choose_ava" accept="image/*" name="use_avatar">
                        <label for="bt_choose_ava" id="label_choose_ava" class="lable_ava">Chọn ảnh</label>
                    </div>
                    <span class="register_error_field" id="register_avatar_error"></span>
                </div>

                <input type="submit" value="Save" id="submit_edit">
                <p class="register_error_field">
                    <span id="register_error"></span>
                </p>
            </div>
        </form>
    </div>
</div>