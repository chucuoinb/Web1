
<div id="register">
    <form class="form" id="form_register" method="post" action=$_SERVER['DOCUMENT_ROOT']."/php/storeUser.php" enctype="multipart/form-data" target="_blank">

        <div>
            <p class="title_register">Register Customers</p>

            <div id="field_name" class="field_register">
                <p class="title_input">Họ tên: <span>*</span></p>
                <div>
                    <input type="text" id="input_name" class="register_input" name="use_fullname">
                    <i class="fa fa-check register_validate" id="register_name_true" aria-hidden="true"></i>
                </div>

                <span class="register_error_field" id="register_name_error"></span>

            </div>

            <div id="field_email" class="field_register">
                <p class="title_input">Email: <span>*</span></p>
                <div>
                    <input type="text" id="input_email" class="register_input" name="use_email">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="register_email_true"></i>
                </div>
                <span class="register_error_field" id="register_email_error"></span>
            </div>

            <div id="field_username" class="field_register">
                <p class="title_input">Tên đăng nhập: <span>*</span></p>
                <div>
                    <input type="text" id="input_username" class="register_input" name="use_username">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="register_username_true"></i>
                </div>
                <span class="register_error_field" id="register_username_error"></span>
            </div>

            <div id="field_password" class="field_register">
                <p class="title_input">Mật khẩu: <span>*</span></p>
                <div>
                    <input type="password" id="input_password" class="register_input" name="use_password">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="register_password_true"></i>
                </div>
                <span class="register_error_field" id="register_password_error"></span>
            </div>

            <div id="field_password2" class="field_register">
                <p class="title_input">Nhập lại mật khẩu: <span>*</span></p>
                <div>
                    <input type="password" id="input_password_2" class="register_input">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="register_password_true2"></i>
                </div>
                <span class="register_error_field" id="register_password_error2"></span>
            </div>

            <div id="field_address" class="field_register">
                <p class="title_input">Địa chỉ: <span>*</span></p>
                <div>
                    <input type="text" id="input_address" class="register_input" name="use_address">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="register_address_true"></i>
                </div>
                <span class="register_error_field" id="register_address_error"></span>
            </div>

            <div id="field_phone_number" class="field_register">
                <p class="title_input">Số điện thoại: <span>*</span></p>
                <div>
                    <input type="text" id="input_phone_number" class="register_input" name="use_phone_number">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="register_phone_true"></i>
                </div>
                <span class="register_error_field" id="register_phone_error"></span>
            </div>

            <div id="field_gender" class="field_register">
                <p class="title_input">Giới tính: <span>*</span></p>
                <div>
                    <input id="male" type="radio" name="use_gender" value="0" checked="checked"> Nam
                    <input type="radio" name="use_gender" value="1"> Nữ
                </div>
            </div>

            <div id="field_birthday" class="field_register">
                <p class="title_input">Ngày sinh: <span>*</span></p>
                <div>
                    <select name="" id="day">
                        <?php
                        for ($i = 1;$i<=31;$i++){
                            echo '<option value="'.$i.'" id = "day'.$i.'">'.$i.'</option>';
                        }
                        ?>
                        <!--                            <option value="1" id="day1">1</option>-->

                    </select>
                    <select name="" id="month">
                        <?php
                        for ($i = 1;$i<=12;$i++){
                            echo '<option value="'.$i.'" id = "month'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                    <select name="" id="year">
                        <?php
                        for ($i = 1960;$i<=2017;$i++){
                            echo '<option value="'.$i.'" id = "year'.$i.'">'.$i.'</option>';
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
                    <textarea id="input_note" class="register_input" name="use_description"></textarea>
                </div>
                <span class="register_error_field" id="register_note_error"></span>
            </div>

            <div id="field_avatar" class="field_register">
                <p class="title_input">Ảnh đại diện: <span>*</span></p>
                <div>
                    <div id="input_avatar">
                        <img id="img_avatar" alt="">
                    </div>
                    <input type="file" value="Chọn ảnh" id="bt_choose_ava" accept="image/*" name="use_avatar" hidden>
                </div>
                <span class="register_error_field" id="register_avatar_error"></span>
                <label for="bt_choose_ava" id="label_choose_ava" class="lable_ava">Chọn ảnh</label>
            </div>

            <input type="submit" value="Register" id="submit_register">
            <p class="register_error_field">
                <span id="register_error"></span>
            </p>
        </div>
    </form>
</div>