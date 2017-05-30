<?php
$list = getAllProduct();
$dir = "/uploads/pro_image/";
$listHost = getProductHot();
?>

<div class="banner">
    <div class="slide">
        <a href="#1"><img id="pos1" class="slideshow" src="/images/Back1.jpg"/></a>
        <a href="#1"><img id="post2" class="slideshow" src="/images/slideshow1.jpg"/></a>
        <a href="#1"><img id="post3" class="slideshow" src="/images/slideshow2.png"/></a>
        <a href="#1"><img id="post4" class="slideshow" src="/images/slideshow3.png"/></a>
        <!-- <a href="#back"><img id="back" src="/images/But5.png"/></a>
         <a href="#next"><img id="next" src="/images/But4.png"/></a> <-->
        <button id="next">></button>
        <button id="back"><</button>
        <!-- <img id="dot1" src="/images/But1.png"/>
         <img id="dot2" src="/images/But2.png"/>
         <img id="dot3" src="/images/But3.png"/> <-->
        <div class="dot">
            <div id="dot1" class="dotE"></div>
            <div id="dot2" class="dotE"></div>
            <div id="dot3" class="dotE"></div>
            <div id="dot4" class="dotE"></div>

        </div>
    </div>
</div>
<div class="choose">
    <div class="best">
        <img src="/images/SP2.png"/>
        <h2>Best price</h2>
        <h3>this week</h3>
    </div>
    <div class="new">
        <img src="/images/SP3.png"/>
        <h2>New smells</h2>
        <h3>in the next series</h3>
    </div>
    <div class="natural">
        <img src="/images/SP4.png"/>
        <h2>Only natural</h2>
        <h3>air fresheners</h3>
    </div>
</div>
<div class="list_home">
    <div id="list_item_product_title">
        <p>Hot Products</p>
        <div>
            <div id="pre_list_home"><img src="/images/bt_previous.png" alt=""></div>
            <div id="next_list_home"><img src="/images/bt_next.png" alt=""></div>
        </div>
    </div>
    <div id="list_item_product">
        <?php
        $countHot = count($listHost);
        if ($countHot < 5)
            $length = $countHot;
        else{
            if ($countHot == 5)
                array_push($listHost,$listHost[4]);
            $length = 6;
        }
        for ($i = 0; $i < $length; $i++) {
            if ($countHot<5)
                $index = $i +1;
            else
                $index = $i;
            echo '
            <div class="list_item_product list_item_home" id="list_item_home_item'.$index.'" >
            <div>
                <div class="sale"></div>
                <div class="list_item_product_item" onclick="goProducts('.$listHost[$i][PRO_ID].')" id="go_product_'.$i.'">
                    <div>
                        <img id="list_item_home_img'.$index.'" src="'.$dir.$listHost[$i][PRO_IMAGE].'" class="center"
                             alt="">
                    </div>
                    <p id="name_pro'.$index.'">'.$listHost[$i][PRO_NAME].'</p>
                </div>
                <div class="list_item_product_price">
                    <div class="price_product">
                        <span class="product_sale"><span
                                    id="list_item_product_price'.$index.'">'.number_format($listHost[$i][PRO_PRICE],0,",",".") .' VNĐ</span></span> <br>
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
                    <div class="bay content_price" id="bay_home"'.$i.' onclick="addCart('.$listHost[$i][PRO_ID].',1)">
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
<div class="list_home">
    <div id="list_item_product_title">
        <p>New Products</p>
        <div>
            <div id="pre_list_home2"><img src="/images/bt_previous.png" alt=""></div>
            <div id="next_list_home2"><img src="/images/bt_next.png" alt=""></div>
        </div>
    </div>
    <div id="list_item_product">
        <?php
        $countProduct = count($list);
        if ($countProduct < 5)
            $length2 = $countProduct;
        else{
            if ($countProduct == 5)
                array_push($list,$list[4]);
            $length2 = 6;
        }
        for ($i = 0; $i < $length2; $i++) {
            if ($countProduct<5)
                $index = $i +1;
            else
                $index = $i;
            echo '
             <div class="list_item_product list_item_home2" id="list_item_home_item'.$index.'" >
            <div>
                <div class="sale"></div>
                <div class="list_item_product_item" onclick="goProducts('.$list[$i][PRO_ID].')" id="go_product2_'.$index.'">
                    <div>
                        <img id="list_item_home_img2'.$index.'" src="'.$dir.$list[$i][PRO_IMAGE].'" class="center"
                             alt="">
                    </div>
                    <p id="name_pro2'.$index.'">'.$list[$i][PRO_NAME].'</p>
                </div>
                <div class="list_item_product_price">
                    <div class="price_product">
                        <span class="product_sale"><span
                                    id="list_item_product_price2'.$index.'">'.number_format($list[$i][PRO_PRICE],0,",",".").' VNĐ</span></span> <br>
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
                    <div class="bay content_price" onclick="addCart('.$list[$i][PRO_ID].',1)" id="bay'.$index.'">
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