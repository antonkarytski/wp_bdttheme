<?php wp_enqueue_script('bdt-google-map'); ?>
<script>
    function initMap() {
        const privolny = {lat: 53.795579, lng: 27.7870457};
        const map = new google.maps.Map(document.getElementById('bgmap'), {
            center: privolny,
            zoom: 11
        });
        const marker = new google.maps.Marker({
            position: privolny,
            map: map
        });
    }
    initMap();
</script>