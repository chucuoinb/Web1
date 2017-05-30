<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/26/2017
 * Time: 8:58 AM
 */
$dir = "/uploads/news/";
$id = getValue(NEW_ID, INT, 1, GET);
$news = getNewById($id);
$date = new DateTime();
$date->setTimestamp($news[NEW_TIME_CREATE]);
$date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
$time = $date->format("H:i| d/m/Y");
$tags = getAllTagsNew($id);
?>
<div class="content_news">
    <p class="title_read_new"><?php echo $news[NEW_TITLE] ?></p>
    <p class="time_read_new"><?php echo $time?></p>
    <img src="<?php echo $dir.$news[NEW_IMAGE]?>" alt="" id="img_read_new">
    <p id="des_read_new"><?php echo $news[NEW_DESCRIPTION]?></p>

    <div class="content_news_ck">
    <?php echo $news[NEW_CONTENT]?>
    </div>
    <?php
        if (count($tags)>0){
            echo '
                    
                    <div id="tag_read_new">
                    <span>Tags</span>
                    <ul id="list_tag">';
            foreach ($tags as $tag){
                echo '
                    <li><a href="/home/news.php?tag_id='.$tag[TAG_ID].'">'.$tag[TAG_NAME].'</a></li>
                ';
            }


            echo '</ul> </div>';
        }
    ?>
</div>
