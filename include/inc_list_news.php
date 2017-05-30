<?php
$list_news = getAllNews();
$tag_name = false;
if (isset($_GET[TAG_ID])){
    $tag_id = getValue(TAG_ID,INT,0,GET);
    $tag_name = getNameTag($tag_id);
    $list_news = getNewsByTag($tag_id);
}
$dir = "/uploads/news/"
?>
<div class="content_news">

    <?php
    if ($tag_name)
        echo '<p id="tag_list_new">'.$tag_name.'</p>';
    foreach ($list_news as $new) {
        $last_update = "";
        if ($new[NEW_TIME_CREATE] > 0) {
            $date = new DateTime();
            $date->setTimestamp($new[NEW_TIME_CREATE]);
            $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
            $last_update = $date->format("H:i:s, d/m/Y");
        }
        echo '
            <div class="list_news">
                <img src="' . $dir . $new[NEW_IMAGE] . '">
                <div class="list_news_des">
                    <p class="news_title"><a href="/home/read_new.php?new_id='.$new[NEW_ID].'">' . $new[NEW_TITLE] . '</a></p>
                    <p class="news_time">' . $last_update . '</p>
                    <p class="news_des"> ' . $new[NEW_DESCRIPTION] . '</p>
                </div>
            </div>
            ';
    }
    ?>

</div>
