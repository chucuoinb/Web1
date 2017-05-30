<?php
?>
<div id="admin_left">
    <a href="/home">

    <div id="logo_admin">
        <div class="center">
            <div class="center">
                <p class="admin_logo">fg</p>
            </div>
        </div>
    </div>
    </a>
    <div id="admin_menu">
        <ul>
            <li class="
            <?php
            if ($_SERVER['PHP_SELF'] == "/admin/index.php")
                echo "active_admin";
            else
                echo "";
            ?>
                menu_admin">
                <div></div>
                <a href="/admin/index.php" class="text_menu_admin">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu_admin">
                <a href="##" class="text_menu_admin">
                <div></div>
                    <span>
                    Posts
                    </span>
                    <img src="/images/admin_logo1.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Media
                    </span>
                    <img src="/images/admin_logo2.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Pages
                    </span>
                    <img src="/images/admin_logo3.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Links
                    </span>
                    <img src="/images/admin_logo4.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Comments
                    </span>
                    <div class="menu_noti">
                        <p>7</p>
                    </div>
                    <img src="/images/admin_logo5.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Widgets
                    </span>
                    <img src="/images/admin_logo6.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Plugins
                    </span>
                    <div class="menu_noti">
                        <p>2</p>
                    </div>
                    <img src="/images/admin_logo7.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin
            <?php
            $name = $_SERVER['PHP_SELF'];
            $temp = explode("/",$name);
            if ($temp[2] == "users")
                echo "active_admin";
            else
                echo "";
            ?>">
                <div></div>
                <a href="/admin/users" class="text_menu_admin ">
                    <span>
                        Users
                    </span>
                    <img src="/images/admin_logo8.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin
            <?php
            $name = $_SERVER['PHP_SELF'];
            $temp = explode("/",$name);
            if ($temp[2] == "categories")
                echo "active_admin";
            else
                echo "";
            ?>">
                <div></div>
                <a href="##" class="text_menu_admin ">
                    <span>
                        Categories
                    </span>
                </a>
            </li>
            <li class="menu_admin
            <?php
            $name = $_SERVER['PHP_SELF'];
            $temp = explode("/",$name);
            if ($temp[2] == "product")
                echo "active_admin";
            else
                echo "";
            ?>">
                <div></div>
                <a href="##" class="text_menu_admin ">
                    <span>
                        Products
                    </span>
                </a>
            </li>
            <li class="menu_admin
            <?php
            $name = $_SERVER['PHP_SELF'];
            $temp = explode("/",$name);
            if ($temp[2] == "news")
                echo "active_admin";
            else
                echo "";
            ?>">
                <div></div>
                <a href="##" class="text_menu_admin ">
                    <span>
                        News
                    </span>
                </a>
            </li>
            <li class="menu_admin
            <?php
            $name = $_SERVER['PHP_SELF'];
            $temp = explode("/",$name);
            if ($temp[2] == "tags")
                echo "active_admin";
            else
                echo "";
            ?>">
                <div></div>
                <a href="##" class="text_menu_admin ">
                    <span>
                        Tags
                    </span>
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Tools
                    </span>
                    <img src="/images/admin_logo9.png" alt="" class="img_menu">
                </a>
            </li>
            <li class="menu_admin">
                <div></div>
                <a href="##" class="text_menu_admin">
                    <span>
                        Setting
                    </span>
                    <img src="/images/admin_logo10.png" alt="" class="img_menu">
                </a>
            </li>
        </ul>
    </div>
</div>