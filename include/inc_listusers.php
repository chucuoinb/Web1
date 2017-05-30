<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>List User</span>
    </div>
    <table class="list">
        <tr class="title_table">
            <th>Id</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Time Create</th>
            <th>Last update</th>
            <th>Active</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php
        $res["role"] = getValue(USE_ROLE, INT, 0, SESSION);
        $res["id"] = getValue(USE_ID, INT, 0, SESSION);
        $list = getAllUsername();
        if ($list) {
            foreach ($list as $item) {
                if ($item[USE_LAST_UPDATE] > 0) {
                    $date = new DateTime();
                    $date->setTimestamp($item[USE_LAST_UPDATE]);
                    $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
                    $last_update = $date->format("H:i:s, d/m/Y");
                } else
                    $last_update = "";
                $nameRole = "";
                switch ($item[USE_ROLE]) {
                    case '0':
                        $nameRole = "normal";
                        break;
                    case '1':
                        $nameRole = "admin";
                        break;
                    case '2':
                        $nameRole = "super_admin";
                }
                if ($item[USE_ACTIVE] == '1') {
                    $nameActive1 = "display_active";
                    $nameActive0 = "non_display_active";
                } else {
                    $nameActive0 = "display_active";
                    $nameActive1 = "non_display_active";
                }
                echo '
            <tr>
                <input type="text" value="' . $item[USE_ID] . '" name="use_id" hidden="true" class="submit_edit_id">
                <input type="text" value="' . $item[USE_ROLE] . '" name="use_role" hidden="true" class="submit_edit_role">
                <th>' . $item[USE_ID] . '</th>
                <th>' . $item[USE_USERNAME] . '</th>
                <th>' . $item[USE_FULLNAME] . '</th>
                <th>' . $item[USE_TIME_CREATE] . '</th>
                <th>' . $last_update . '</th>
                <th>
                    <div class="bt_active">
                    <div class="admin_active1 use_active1 ' . $nameActive1 . '">
                    <i class="fa fa-check " aria-hidden="true"></i>
                    </div>
                    <div class="admin_active0 use_active0 ' . $nameActive0 . '">
                    <span>active</span>
                    </div>
                   </div>
                </th>
                <th>
                    <p class="' . $nameRole . '">
                    ' . $nameRole . ' 
                    </p>
                </th>
                <th>
                    <div class="bt_change">
                    
                        <div class="bt_edit use_edit">
                        <a href="/admin/users/edit.php?id='.$item[USE_ID].'" onclick="return isRedirect('.$res["role"].','.$item[USE_ROLE].','.$res["id"].','.$item[USE_ID].');" ">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        </div>
                    
                        <div class="bt_delete use_delete">
                             <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                    </div>
                </th>
            </tr>
        ';
            }
        }

        ?>
    </table>




</div>

</div>