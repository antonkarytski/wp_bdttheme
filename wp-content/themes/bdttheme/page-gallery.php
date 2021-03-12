<?php
//Template name: Gallery
get_header();
$map_flag = get_field("map-show-trigger",get_post());
$addClass = "";
if($map_flag) {
    wp_enqueue_script( 'bdt-google-map');
}
else {
    $addClass = " no-map";
}
?>

<div id="site-body" class="gallery <?php echo $addClass ?>">

    <?php
    the_post();
    $taxonomy_id = get_field("gallery-taxonomy");
    if($map_flag):
        $map_data = get_field("map_marks_data","bdt_gallery_cat_".$taxonomy_id);
    ?>
        <div id = "bgmap" class="block-map" style="background-color: #3A87AD; height: 75vh; width: 100%;">
            <script>
                function initMap() {
                    window.galleryGoogleMap = {};
                    window.galleryGoogleMap.map = new google.maps.Map(document.getElementById('bgmap'), {
                        center: new google.maps.LatLng(55.3008998, 44.4011453),
                        zoom: 4,
                        mapTypeControl:
                            false
                    });

                    window.galleryGoogleMap.infoMaps = [];
                    let xmlMapData = <?php echo "\"<xml>".str_replace("\"","\\\"",$map_data)."</xml>\""?>;
                    let parser = new DOMParser();
                    xmlMapData = parser.parseFromString(xmlMapData,"text/xml");
                    let records = xmlMapData.querySelectorAll('mark');
                    records.forEach(function(e){
                        let markTitle = e.querySelector("title");
                        let markText = e.querySelector("text");
                        let markId = e.querySelector("id").innerHTML;
                        let coordinates = e.querySelectorAll("coordinates coordinate");
                        coordinates.forEach(coordinate =>{
                            window.galleryGoogleMap.infoMaps[markId] = new google.maps.InfoWindow;
                            let markerPosition = {lat: Number(coordinate.querySelector("lat").innerHTML), lng: Number(coordinate.querySelector("lng").innerHTML)};
                            let marker = new google.maps.Marker({
                                position: markerPosition,
                                map: window.galleryGoogleMap.map,
                                title: markTitle.innerHTML
                            });

                            marker.addListener('click', function() {
                                window.galleryGoogleMap.infoMaps[markId].setContent("<h4>"+markTitle.innerHTML+"</h4><div style=\"width: 200px; height: 200px; background-color: white;\">"+markText.innerHTML+"</div>");
                                window.galleryGoogleMap.infoMaps[markId].open(window.galleryGoogleMap.map, marker);
                            });
                        });
                    });
                }
            </script>
        </div>
    <?php
    endif;
    ?>
<div class="block-gallery ext-gallery">
        <?php
        $posts = get_posts( array(
            'numberposts' => -1,
            'post_type'   => 'bdt_gallery',
            'tax_query' => array(
                array(
                'taxonomy' => 'bdt_gallery_cat',
                'field' => 'term_id',
                'terms' => $taxonomy_id,
                )
            ),
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        ) );

        foreach( $posts as $post ){
            setup_postdata($post);
            $img = get_the_post_thumbnail($post->ID,'thumbnail');
            $link = get_permalink();
            $title = "";
            if(get_field("title-show"))
                $title = get_the_title();
            $short_text = "";

            if(get_field("description-show")) $short_text = "<p>".get_field("map_short_desc")."</p>";
            echo "<div class=\"item\">";
            if(get_field("gallery_fast_post")) echo "<a data-fancybox data-type=\"ajax\" data-src=\"$link?fast=1\" href=\"javascript:;\">";
            else echo "<a href=\"$link\">";
            echo "<div class=\"overlay\">$title<br>$short_text</div>";
            echo "$img</a></div>";
        }
        wp_reset_postdata();
        ?>
</div>
</div>
<?php get_footer(); ?>
