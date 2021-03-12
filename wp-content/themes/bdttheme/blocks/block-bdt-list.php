<?php
if(block_value('visible')):
    $wrapCustomClasses = block_value('custom-classes');
    $columnsCount = block_value('columns');
    $colMdOffset = 0;
    switch ($columnsCount)
    {
        case 1:
            $colXs = 12;
            $colMd = 10;
            $colMdOffset = 1;
            break;
        case 2:
            $colXs = 6;
            $colMd = 5;
            $colMdOffset = 1;
            break;
        default:
            $colXs = 12;
            $colSm = 6;
            $colMd = 12/$columnsCount;
    }


    $renderString = "<div class=\"row block-list $wrapCustomClasses\">";
    if(block_value('title'))
    {
        $title = block_value('title');
        $renderString .= "<header class=\"main-header\"><h2>$title</h2></header>";
    }

    $columnsData = [];

    for($i = 0; $i<$columnsCount; $i++)
    {
        if($i != 0)
        {
            $colMdOffset = 0;
        }
        $columnsData[] = "<div class=\"col-xs-12 col-xs-offset-0 col-sm-$colSm col-sm-offset-1 col-md-$colMd col-md-offset-$colMdOffset\">";
    }

    $columnIndex = 0;
    while(block_rows('list-items')) {
        block_row('list-items');
        $image = "";
        if(block_sub_value('item-image'))
        {
            $image = wp_get_attachment_url(block_sub_value('item-image'));
            $image = "<img alt=\"\" src=\"$image\">";
        }

        $title = block_sub_value('item-title');
        $text = block_sub_value('item-text');
        $columnsData[$columnIndex] .= "<div class=\"row part-block\">";
        $columnsData[$columnIndex] .= "<div class=\"img-block pull-left\">";
        $columnsData[$columnIndex] .= $image;
        $columnsData[$columnIndex] .= "</div>";
        $columnsData[$columnIndex] .= "<div class=\"text-block\">";
        $columnsData[$columnIndex] .= "<header><h3>$title</h3></header>";
        $columnsData[$columnIndex] .= "<p>$text</p>";
        $columnsData[$columnIndex] .= "</div>";
        $columnsData[$columnIndex] .= "</div>";

        if($columnIndex < $columnsCount-1)
            $columnIndex++;
        else
            $columnIndex = 0;
    }

    for($i = 0; $i<$columnsCount; $i++)
    {
        $columnsData[$i] .= "</div>";
        $renderString .= $columnsData[$i];
    }

    $renderString .= "</div>";
    echo $renderString;
    reset_block_rows( 'inside-blocks');
?>
<?php
endif;
