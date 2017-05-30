<?php
require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
$temp = "";
$role = isset($_COOKIE["save"]) ? getValue(USE_ROLE, INT, 0, COOKIE) :
    (getValue(USE_ROLE, INT, 0, SESSION));
$avatar = isset($_COOKIE[USE_AVATAR]) ? getValue(USE_AVATAR, STRING, "", COOKIE) :
    (getValue(USE_AVATAR, STRING, "", SESSION));
if ($role == 1)
    echo '
            <script type="text/javascript">
        $(document).ready(function () {
               $("#name_admin").removeAttr("class");
                $("#fullname_admin").removeAttr("class");
                $("#name_admin").addClass("admin");
                $("#fullname_admin").addClass("admin");
                $("#avatar_admin").attr("src","/uploads/'.$avatar.'")'.
        '})'.
        '</script>';
else
    echo '
            <script type="text/javascript">
        $(document).ready(function () {
               $("#name_admin").removeAttr("class");
                $("#fullname_admin").removeAttr("class");
                $("#name_admin").addClass("super_admin");
                $("#fullname_admin").addClass("super_admin");
                $("#avatar_admin").attr("src","/uploads/'.$avatar.'")'.
        '})'.
    '</script>';

?>
<div id="footer_admin">
    <div>
        <div class="color_footer">
            <i class="fa fa-twitter " aria-hidden="true"></i>
            <span>Free admin template By <span id="name_admin">
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
                    require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
                    if (isset($_COOKIE["save"])) {

                        echo getValue(USE_USERNAME, STRING, "My Account", COOKIE);
                    } else
                        echo getValue(USE_USERNAME, STRING, "My Account", SESSION);
                    ?>
                </span>  (freebiesgallery.com)</span>
        </div>
        <div id="admin_account">
            <div id="admin_account_img">
                <img src="/images/bigimage01.jpg" alt="" id="avatar_admin">
                <p id="fullname_admin">
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT']."/function/function.php");
                    require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
                    if (isset($_COOKIE["save"])) {

                        echo getValue(USE_FULLNAME, STRING, "My Account", COOKIE);
                    } else
                        echo getValue(USE_FULLNAME, STRING, "My Account", SESSION);
                    ?>
                </p>
            </div>
            <div class="setting_admin" id="setting_admin">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </div>
            <div class="setting_admin" id="logout_admin">
                <i class="fa fa-power-off" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>
