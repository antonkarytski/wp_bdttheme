<?php
$iconBlock = "";
$iconData = block_value("icon-name");
if($iconData) {
    if (block_value("icon-type") == "custom") {
        $iconBlock = "<span><i class=\"icon-bdt-$iconData\"></i></span>";
    } elseif (block_value("icon-type") == "fa") {
        $iconBlock = "<span class=\"$iconData\"><i class=\"fa fa-$iconData\"></i></span>";
    }
}
$iconHead = block_value("header");
$iconText = block_value("text");
$id = block_value("id");
$iconSize = block_value("icon-size");
$classes = block_value("additional-classes");
$hLvl = block_value("header-level");
$sepBtw = block_value("separator-between");

if($id) $id = " id = \"$id\"";
if($iconSize != "std-icon") $classes = $classes." ".$iconSize;
if(!$sepBtw) $classes = $classes." sep-off";
if(!($iconHead||$iconText)) $classes = $classes." one-icon";
?>

<div class="single-icon <?php echo $classes.$id;?>">
    <?php if($iconBlock): ?>
    <div class="icon-block">
        <?php echo $iconBlock; ?>
    </div>
    <?php
    endif;

    if($iconHead||$iconText): ?>
    <div class="text-block">
        <?php
        if($iconHead) echo "<h$hLvl>$iconHead</h$hLvl>";

        $wrap = "";
        $wrap_end = "";
        if(block_value("text-wrap")) {
            $wrap = "<p>";
            $wrap_end = "</p>";
        }
        if($iconText) echo $wrap.$iconText.$wrap_end;
        ?>
    </div>
    <?php endif; ?>
</div>
