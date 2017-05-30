<?php
$id = getValue("id", INT, 0, GET);

$position = 1;
$pro = getProById($id);
$cat_id = $pro[CAT_ID];
$list = getListProduct($cat_id);
for ($i = 0; $i < count($list); $i++) {
    if ($list[$i][PRO_ID] == $id)
        $position = $i;
}
if ($position > count($list) - 1)
    $position = 1;
$positionClone = $position;
$cat = getListCategories();
$dir = "/uploads/pro_image/";
$listHotNew = getHotNew(2);

?>
<input type="text" value="<?php echo $cat_id ?>" hidden id="cat_id">
<div id="product_view">
    <div class="container">

        <div id="title_product">
            <ul>
                <li><a>Home</a></li>
                <li> ></li>
                <li><a>Category</a></li>
                <li> ></li>
                <li><a>This page</a></li>
            </ul>
        </div>
        <div id="content_product">
            <?php
            include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_left_product.php");
            ?>
            <div id="right_content_product">
                <div id="right_content_top">
                    <p class="title_content_product"><?php echo $list[$positionClone][PRO_NAME]?></p>
                    <div id="right_product_content">
                        <div id="right_product_left">
                            <div id="item_large">
                                <img id="img_item_large" src="<?php echo $dir . $list[$position][PRO_IMAGE] ?>">
                                <div class="sale">
                                    <img src="/images/logo4.png">
                                </div>
                            </div>
                            <div id="list_item_right">
                                <?php
                                echo '
                                <div class="list_item_right" id="list_item_right_item1" onclick="changeLarge(' . $list[$position][PRO_ID] . ')">
                                    <div>
                                        <img id="list_item_right_img1" src="' . $dir . $list[$position][PRO_IMAGE] . '"
                                             alt="">
                                    </div>
                                </div>
                                ';
                                //                                $countProduct = count($list);
                                //                                if ($countProduct < 5)
                                //                                    $length = $countProduct;
                                //                                else {
                                //                                    if ($countProduct == 5)
                                //                                        array_push($list, $list[4]);
                                //                                    $length = 6;
                                //                                }
                                //                                for ($i=0;$i<$length;$i++){
                                //                                    if ($countProduct < 5){
                                //                                        $index = $i + 1;
                                //                                        $pos = $position;
                                //                                    }
                                //                                    else{
                                //                                        $index = $i;
                                //                                        $pos = ($position == 0)?(count($list)-1):$position-1;
                                //                                    }
                                //                                    echo '
                                //                                <div class="list_item_right" id="list_item_right_item'.$index.'" onclick="changeLarge('.$list[$pos][PRO_ID].')">
                                //                                    <div>
                                //                                        <img id="list_item_right_img'.$index.'" src="'.$dir . $list[$pos][PRO_IMAGE].'"
                                //                                             alt="">
                                //                                    </div>
                                //                                </div>
                                //                                ';
                                //                                    $position = ($position == count($list)-1)?0:$position+1;
                                //                                }

                                ?>
                            </div>
                            <div id="product_button">
                                <div id="product_bt_pre"><img src="/images/bt_previous.png"></div>
                                <div id="product_bt_next"><img src="/images/bt_next.png"></div>
                            </div>
                        </div>
                        <div id="right_product_right">
                            <div id="review">
                                <i class="fa fa-star bt_vote" aria-hidden="true"></i>
                                <i class="fa fa-star bt_vote" aria-hidden="true"></i>
                                <i class="fa fa-star bt_vote" aria-hidden="true"></i>
                                <i class="fa fa-star bt_vote" aria-hidden="true"></i>
                                <i class="fa fa-star bt_vote" aria-hidden="true"></i>
                                <p>1 REVIEW (S)</p>
                                <div><p>ADD YOUR REVIEW</p></div>
                            </div>
                            </p>
                            <div id="price_large">
                                <div id="price_large_left">
                                    <p>Availability:
                                        <span class="colorBlue">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        In stock
                                        </span>
                                    </p>
                                    <p>SKU: <span class="colorBlack"> Candles OV</span></p>
                                </div>
                                <div id="price_large_right">
                                    <p id="price_large_sale"><span
                                                id="price_item_large"><?php echo number_format($list[$positionClone][PRO_PRICE], 0, "", ".") ?>
                                            VNĐ</span></p>
                                </div>
                            </div>
                            <div id="add_to_cart">
                                <div id="add_to_cart_left">
                                    <div>
                                        <img src="/images/logo2.png" alt="">
                                        <p>Add to compare</p>
                                    </div>
                                    <div>
                                        <img src="/images/logo1.png" alt="">
                                        <p>Add to compare</p>
                                    </div>
                                </div>
                                <div id="add_to_cart_right">
                                    <p>Quantity: </p>
                                    <div>
                                        <input id="number_of_item" type="text" value="1">
                                        <span id="number_of_item_error"></span>
                                        <div id="bt_add_cart"
                                             onclick="btAddCart(<?php echo $list[$positionClone][PRO_ID] ?>)"><p>Add To
                                                Cart</p></div>
                                    </div>
                                </div>
                            </div>
                            <img src="/images/logo_details.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div id="tab_product">
                    <ul id="title_tab_product">
                        <li class=" tab tab_choose"><a href="##">Description</a></li>
                        <li class="  tab"><a href="##">Reviews</a></li>
                        <li class="tab"><a href="##">Custom Tab</a></li>
                    </ul>
                    <div class="line"></div>
                    <div id="content_tab">
                        <div class="content_tab tab_display" id="tab_des">
                            <p>Tables Style</p>

                            <div id="des_pro_img">
                                <img class="center" src="<?php echo $dir . $list[$position][PRO_IMAGE] ?>" alt="">
                            </div>
                            <div id="pro_des">
                                <p id="des_name"><span><?php echo $list[$position][PRO_NAME] ?></span></p>
                                <p id="des_des"><?php echo $list[$position][PRO_DESCRIPTION] ?></p>
                                <p id="des_price"><?php echo number_format($list[$position][PRO_PRICE], 0, "", ".") ?>
                                    VNĐ</p>
                            </div>
                        </div>
                        <div class="content_tab ">
                            <p>Customer reviews</p>
                            <form id="form_review">

                                <div id="tab2_top">
                                    <div id="nickname" class="tab2_top">
                                        <p class="tab2_p">Nickname <span>*</span></p>
                                        <input type="text" id="input_nickname">
                                        <span id="input_nickname_error" class="error"></span>
                                    </div>
                                    <div id="summary" class="tab2_top">
                                        <p class="tab2_p">Summary Of Your Review <span>*</span></p>
                                        <input type="text" id="input_summary">
                                        <span id="input_summary_error" class="error"></span>
                                    </div>
                                </div>

                                <div id="tab2_bottom">
                                    <p class="tab2_p">Review <span>*</span></p>
                                    <textarea name="" id="review_text"></textarea>
                                    <span id="review_text_error" class="error"></span>

                                    <p id="note_review">Note: HTML is not translated!
                                    </p>
                                </div>

                                <input type="submit" value="submit review" id="submit_form">
                            </form>
                        </div>
                        <div class="content_tab">
                            <p>Custom Tab</p>
                        </div>
                    </div>
                </div>
                <div id="right_product_end">
                    <div id="list_item_product_title">
                        <p>
                            <?php
                            if (isset($_GET[CAT_ID])) {
                                echo getNameCat($_GET[CAT_ID]);
                            } else
                                echo 'Related Products';
                            ?>
                        </p>
                        <div>
                            <div id="pre_product_end"><img src="/images/bt_previous.png" alt=""></div>
                            <div id="next_product_end"><img src="/images/bt_next.png" alt=""></div>
                        </div>
                    </div>
                    <div id="list_item_product">
                        <?php
                        $countProduct = count($list);
                        if ($countProduct < 4)
                            $length = $countProduct;
                        else {
                            if ($countProduct == 4)
                                array_push($list, $list[3]);
                            $length = 5;
                        }
                        for ($i = 0; $i < $length; $i++) {
                            if ($countProduct < 4)
                                $index = $i + 1;
                            else
                                $index = $i;

                            $image = $dir . $list[$i][PRO_IMAGE];
                            $price = $list[$i][PRO_PRICE];
                            $name = $list[$i][PRO_NAME];
                            echo '
                        <div class="list_item_product" id="list_item_product_item' . $index . '">
                            <div>
                                <div class="list_item_product_item" onclick="goProducts(' . $list[$i][PRO_ID] . ')" id="go_product_end' . $index . '">
                                    <div>
                                        <img id="list_item_product_img' . $index . '" src="' . $dir . $list[$i][PRO_IMAGE] . '"
                                             class="center"
                                             alt="">
                                    </div>
                                    <p id="name_pro' . $index . '">' . $list[$i][PRO_NAME] . '</p>
                                </div>
                                <div class="list_item_product_price">
                                    <div class="price_product">
                                        <span class="product_sale"><span
                                                    id="list_item_product_price' . $index . '">' . number_format($list[$i][PRO_PRICE], 0, ",", ".") . ' VNĐ</span></span>
                                        <br>
                                    </div>
                                    <div class="obn content_price">
                                        <div>
                                            <img class="center" src="/images/logo2.png" alt="">

                                        </div>
                                    </div>
                                    <div class="like content_price">
                                        <div>
                                            <img class="center" src="/images/logo1.png" alt="">

                                        </div>
                                    </div>
                                    <div class="bay content_price" onclick="addCart(' . $list[$i][PRO_ID] . ',1);" id="bay_end' . $i . '">
                                      
                                        <div>
                                            <img class="center" src="/images/logo3.png" alt="">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
