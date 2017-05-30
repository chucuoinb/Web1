<?php
$res = getListCategories();
?>
<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>Add Product</span>
    </div>

    <form action="" class="form_cat" method="post" id="form_add_pro" enctype="multipart/form-data">
        <div>
            <p class="title_form">Categories <span>*</span></p>
            <select  name="cat_id" id="choose_cat" >
                <?php
                foreach ($res as $cat){
                    echo '
                            <option value="'.$cat[CAT_ID].'">'.$cat[CAT_NAME].'</option>
                            ';
                }
                ?>
            </select>
        </div>
        <div>
            <p class="title_form">Name <span>*</span></p>
            <input type="text" class="input_form" name="pro_name" >
            <p id="" class="pro_err"></p>
        </div>

        <div>
            <p class="title_form">Price <span>*</span></p>
            <input type="text" class="input_form" name="pro_price" id="pro_price">
            <p id="pro_price_err" class="pro_err" ></p>
        </div>

        <div>
            <p class="title_form">Mô tả <span>*</span></p>
            <input type="text" class="input_form" name="pro_description" >
            <p id="" class="pro_err"></p>
        </div>


        <div>
            <img src="" id="ava_product">
            <input type="file" id="choose_ava_pro" accept="image/*" hidden name="pro_image">
        </div>
        <label for="choose_ava_pro" class="lable_ava" id="lb_choose_pro">Chọn ảnh</label>
        <br>
        <p id="choose_ava_pro_err" class="pro_err"></p>


        <input type="submit" id="submit_add_pro" class="submit_add" value="Lưu">
    </form>
</div>