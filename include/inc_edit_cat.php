<?php
        $id = getValue(CAT_ID,INT,0,GET);
        $cat = getCatById($id);
?>

<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>Edit Categories</span>
    </div>

    <form action="" class="form_cat" method="post" id="form_add_cat">
        <input type="text" hidden="hidden" name="cat_id" value="<?php echo $cat[CAT_ID]?>">
        <div>
            <p class="title_form">Name <span>*</span></p>
            <input type="text" class="input_form" name="cat_name" value="<?php echo $cat[CAT_NAME]?>">
            <p id="cat_name_err" class="cat_err"></p>
        </div>

        <div>
            <p class="title_form">Mô tả <span>*</span></p>
            <input type="text" class="input_form" name="cat_description" value="<?php echo $cat[CAT_DESCRIPTION]?>">
            <p id="cat_name_err" class="cat_err"></p>
        </div>


        <input type="submit" id="submit_add_cat" value="Lưu" class="submit_add">
    </form>
</div>