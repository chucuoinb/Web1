
<?php

$cat = getListCategories();
$dir = "/uploads/pro_image/";
$listHotNew = getHotNew(2);

?><div id="left_content_product">
    <p class="title_content_product">Categories</p>
    <ul id="menu_left_product">
        <?php
        foreach ($cat as $item) {
            if (getNumberProductOfCart($item[CAT_ID]) > 0) {


                echo '
                            <li>
                            <a 
                            href="/home/cat.php?cat_id=' . $item[CAT_ID] . '">
                            ' . $item[CAT_NAME] . ' (' . $item[CAT_NUMBER] . ')</a>
                            </li>
                            ';
            }
        }
        ?>
    </ul>
    <div id="special">
        <p class="title_content_product">Special</p>
        <div id="content_special">
            <?php

            for ($i = 0; $i < count($listHotNew); $i++) {
                if ($i == 0)
                    $noborder = "no_boder";
                else
                    $noborder = "";

                echo '
                            <div class="content_special ' . $noborder . '">
                            <div class="img_content_special">
                                <img src="' . $dir . $listHotNew[$i][PRO_IMAGE] . '">

                            </div>
                            <div class="text_content_special">

                                <p class="note">
                                    ' . $listHotNew[$i][PRO_NAME] . '
                                </p>
                                <p class="price_special">
                                    <span class="price_sale">' . number_format($listHotNew[$i][PRO_PRICE]) . ' VNĐ</span>
                                </p>
                            </div>

                        </div>
                            ';
            }
            ?>

        </div>
    </div>
    <div id="newsletter">
        <p class="title_content_product">Newsletter Signup</p>
        <p id="newsletter_text">Phasellus vel ultricies felis. Duis rhonc
            risus eu urna pretium.</p>
        <div id="newsletter_input">
            <input id="newsletter_input_email" type="text" placeholder="Enter your email address.">
            <i id="newsletter_input_email_true" class="fa fa-check" aria-hidden="true"></i>
        </div>
        <span id="newsletter_input_email_error" class="error"></span>
        <div id="newsletter_button_subscribe">
            <a href="##">

                <p>
                    Subscribe
                </p>
            </a>
        </div>
        <div id="banner">
            <div id="banner_title">
                <p class="title_content_product">Banners</p>
                <div id="banner_bt_next"><img src="/images/bt_next.png" alt=""></div>
                <div id="banner_bt_pre"><img src="/images/bt_previous.png" alt=""></div>
            </div>
            <div id="list_item">

                <div class="banner_items" id="banner_item_0">
                    <img id="img0" src="/images/item0.png" alt="">
                </div>
                <div class="banner_items" id="banner_item_1">
                    <img id="img1" src="/images/item1.png" alt="">
                </div>
                <div class="banner_items" id="banner_item_2">
                    <img id="img2" src="/images/item2.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>