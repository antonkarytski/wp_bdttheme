<?php

if(block_value('visible')):
    $slides = array();
    $i = 0;
    while (block_rows('inside-blocks')) {
        block_row('inside-blocks');
        $slides[$i]["background"] = block_sub_value("background");
        $slides[$i]["navigation-line"] = block_sub_value("navigation-line");
        $slides[$i]["content"] = block_sub_value("content");
        $slides[$i]["url"] = block_sub_value("content");
        $i++;
    }
?>
<div class="block-service-navigation bdt-tabs">
    <div class="navigation">
        <ul class="menu list">
            <?php
            foreach ($slides as $i => $slide){
                $line = $slide["navigation-line"];
                echo "<li><a data-href='$i' href=\"#s$i\">$line</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="content">
        <div class="inside-content-wrap">
        <?php
        foreach ($slides as $i => $slide):
        $content = $slide["content"];
        $bg="";
        if($slide["background"])
        {
            $bg = wp_get_attachment_url($slide["background"]);
            $bg = "style=\"background-image: url($bg);\"";
        }
        ?>
        <div class="inside-content" data-hash="<?php echo $i ?>" <?php echo $bg?>>
            <div class="overlay">
                <?php echo $content; ?>
            </div>
        </div>
        <?php
        endforeach;
        ?>
        </div>
    </div>
</div>
<?php
endif;
reset_block_rows( 'inside-blocks');
?>