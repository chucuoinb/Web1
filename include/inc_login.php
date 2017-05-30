<!--/**-->
<!--// * Created by PhpStorm.-->
<!--// * User: Nam-->
<!--// * Date: 4/21/2017-->
<!--// * Time: 11:31 AM-->
<!--// */-->
<div id="login">
    <form id="form_login"   class="form" target="blank">
        <div>
            <p class="title_register">Login Customers</p>
            <p id="login_suggest">If you have an account with us, please log in.</p>


            <div id="field_email_login" class="field_register">
                <p class="title_input">Email: <span>*</span></p>
                <div>
                    <input type="text" id="input_email_login" class="register_input" name="use_email">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="login_email_true"></i>
                </div>
                <span class="register_error_field" id="login_email_error"></span>
            </div>



            <div id="field_password" class="field_register">
                <p class="title_input">Password: <span>*</span></p>
                <div>
                    <input type="password" id="input_password_login" class="register_input" name="use_password">
                    <i class="fa fa-check register_validate" aria-hidden="true" id="login_password_true"></i>
                    <u id="login_forgot">Forgot your password?</u>
                </div>
                <span class="register_error_field" id="login_password_error"></span>
            </div>
            <div id="remember_pass">
                <input type="checkbox" id="remember_password" checked="checked">
                <p>Remember password</p>
            </div>

            <input type="submit" value="Login" id="submit_login">
            <p class="register_error_field" id="login_error"></p>
        </div>
    </form>
</div>
