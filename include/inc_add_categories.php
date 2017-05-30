<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>Add Categories</span>
    </div>

    <form action="" class="form_cat" method="post" id="form_add_cat">
        <div>
            <p class="title_form">Name <span>*</span></p>
            <input type="text" class="input_form" name="cat_name">
            <p id="cat_name_err" class="cat_err"></p>
        </div>

        <div>
            <p class="title_form">Mô tả <span>*</span></p>
            <input type="text" class="input_form" name="cat_description">
            <p id="cat_name_err" class="cat_err"></p>
        </div>


        <input type="submit" id="submit_add_cat" class="submit_add" value="Thêm">
    </form>
</div>