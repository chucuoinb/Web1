<?php
if (isset($_COOKIE["use_fullname"]) || isset($_SESSION["use_fullname"]))
    echo '<script type="text/javascript">
                $(document).ready(function(e) {
                     $(".logged").css("display","none");
                });
          </script>';
$listCat = getListCategories();
$name = $_SERVER['PHP_SELF'];
?>
<div class="header">
    <div class="contentheader">
        <div class="cntheader">
            <div class="leftheader">
                <div id="cntleftheader">
                    <img style="margin-right: 5px"
                         src="../images/fone.png"/>
                    <p>Call Us +777
                        (100) 1234</p>
                </div>
            </div>
            <div class="middleheader" style="position: absolute;">
                <p style="font-size: 10pt; color: #CCCCCC">
                    Welcome visistor you can <span><a style="text-decoration: none;color: #98d9f9"
                                                      href="../home/login.php">login</a></span>
                    or <span> <a style="text-decoration: none;color: #98d9f9"
                                 href="../home/register.php">create an account</a></span>
                </p>
            </div>
            <div class="rightheader">
                <div class="rheader">
                    <p id="date"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner1">
    <div id="logo">
        <a href="../home"><img src="../images/logo18.png"/></a>
    </div>
    <form id="search" method="get" action="/home/cat.php">
        <div id="innersearch">
            <input type="text" id="inputTex" name="search" placeholder="Search entrie store here..."/>

            <input type="submit" id="bt_search" hidden>
            <label for="bt_search" id="lable_search"><i class="fa fa-search" aria-hidden="true"></i></label>
        </div>
    </form>
    <div id="account">
        <div id="inneraccout">
            <ul id="acc">
                <li>
                    <a class="mmenu1 active1" href="/admin">
                        <span id="home_account">
                            <?php
                            if (isset($_COOKIE["save"])) {

                                echo getValue(USE_FULLNAME, STRING, "My Account", COOKIE);
                            } else
                                echo getValue(USE_FULLNAME, STRING, "My Account", SESSION);
                            ?>
                            <!--                            My Account-->
                        </span>
                    </a>
                </li>
                <li><p>|</p></li>
                <li class="bef"><a class="mmenu1" href="#home"><span>My Wishlist</span></a></li>
                <li><p>|</p></li>
                <li class="bef" id="home_login">
                    <a class="mmenu1" href="#home">
                        <span>
                            <?php
                            echo (isset($_COOKIE[USE_FULLNAME]) || isset($_SESSION[USE_FULLNAME])) ? "Logout" : "Login";
                            ?>
                        </span>
                    </a>
                </li>
                <li class="logged">
                    <p>
                        |
                    </p>
                </li>
                <li class="bef logged"><a class="mmenu1" href="/home/register.php"><span>Sign Up</span></a></li>
                <li id="menu_card">
                    <div id="card">
                        <img src="/images/gio.png">Cart <span id="total_price">0.00</span> VNĐ</img>
                    </div>
                    <ul class="sub-menu1" id="sub_menu1">
                        <li id="add_item"><p>Recently added item(s) <br><span id="no_item" class="error"> </span></p>
                        </li>
                        <li>
                            <div class="checkout">
                                <div class="view">
                                    <p>View shopping cart</p>
                                </div>
                                <div class="ckout">
                                    <p>Proceed to checkout</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<hr/>
<div class="mainmenu" style="color: #444449">
    <div class="menu">
        <ul>

            <li><a class="mmenu <?php if ($name=="/home/index.php") echo 'active'?>" href="/home"><span>HOME</span></a></li>
            <li><a class="mmenu <?php if ($name=="/home/news.php") echo 'active'?>" href="/home/news.php"><span>TIN TỨC</span></a></li>
            <?php
                foreach ($listCat as $item) {
                    if (count(getListProduct($item[CAT_ID])) > 0) {
//                        $name_class = "";
//                        if ($name == "/home/cat.php")
                        echo '
                <li>
                <a class="mmenu " href="/home/cat.php?cat_id='.$item[CAT_ID].'">
                ' . mb_strtoupper($item[CAT_NAME]) . '
                </a>
                ';
//                        $listPro = getListProduct($item[CAT_ID]);
//                        if (count($listPro) > 0) {
//                            echo '
//                    <ul class="sub-menu">
//                    ';
//                            foreach ($listPro as $pro) {
//                                echo '
//                        <li><a href="/home/details.php?id=' . $pro[PRO_ID] . '">' . $pro[PRO_NAME] . '</a></li>
//                        ';
//                            }
//                            echo '
//                    </ul>
//                    ';
//                        }
                    }
                    echo '</li>';
                }

//                echo '
//             <li><a class="mmenu" href="/home/details.php">SOLIDS</a></li>
//                    <li><a class="mmenu" href="#Liquids">LIQUIDS</a></li>
//                    <li><a class="mmenu" href="#home">SPRAY</a>
//                        <ul class="sub-menu">
//                            <li><a href="#">For Home</a></li>
//                            <li><a href="#">For Garden</a></a></li>
//                            <li><a href="#">For Car</a></li>
//                            <li><a href="#">Other Spray</a></li>
//                        </ul>
//                    </li>
//                    <li><a class="mmenu" href="#home">ELECTRIC</a></li>
//                    <li><a class="mmenu" href="#home">FOR CAR</a></li>
//                    <li><a class="mmenu" href="#home">ALL PAGES</a>
//                        <ul class="sub-menu">
//                            <li><a href="/home">Home</a></li>
//                            <li><a href="#">Typography And Basic Styles</a></a></li>
//                            <li><a href="#">Catalog (Grid View)</a></li>
//                            <li><a href="#">Catalog (List Type View)</a></li>
//                            <li><a href="/home/details.php">Product View</a></li>
//                            <li><a href="#">Shoping Cart</a></li>
//                            <li><a href="#">Procced To Checkout</a></li>
//                            <li><a href="#">Products Comparsion</a></li>
//                            <li><a href="/home/login.php">Login</a></li>
//                            <li><a href="#">Contact US</a></li>
//                            <li><a href="#">404</a></li>
//                            <li><a href="#">Blog Posts</a></li>
//                        </ul>
//                    </li>
//            ';
            ?>

        </ul>
    </div>
</div>