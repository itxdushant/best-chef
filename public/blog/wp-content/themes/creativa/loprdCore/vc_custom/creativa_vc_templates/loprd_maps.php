<?php
$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'address' => '1111 5th Avenue, New York',
    'zoom' => 'autozoom',
    'map_type' => 'ROADMAP',
    'marker' => '',
    // 'style' => '',
    'height' => 500,
    'css_animation' => '', 
    'css_animation_delay' => '',
    'css' => '',
), $atts));


$style_code = '""';
// if (!empty($style)) {
// 	$style_code = rawurldecode(base64_decode(strip_tags($style)));
// } else {
// 	$style_code = '""';
// }

$height_style = '';
if (!empty($height)) {
    if (is_numeric($height)) {
        $unit = 'px';
        $row_height_output = $height . $unit;
    } else {
        $row_height_output = $height;
    }
	$height_style = 'style="height:'. esc_attr($row_height_output) .'"';
}


$map_id = rand(0, 9999);
?>

<div id="map-canvas-<?php echo esc_attr($map_id) ?>" class="loprd-google-maps <?php echo creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo ''.$height_style // var escaped ?> <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>></div> 
<script type="text/javascript">



function map_<?php echo esc_attr($map_id) ?>() {
	var geocoder;
	var map;
	var markersArray = [];
	var bounds;
	var infowindow =  new google.maps.InfoWindow({
	    content: ''
	});
	var customStyle = <?php echo ''.$style_code // var escaped ?>;

    geocoder = new google.maps.Geocoder();
    bounds = new google.maps.LatLngBounds ();

    var myOptions = {
      	center: new google.maps.LatLng(43.253205,-80.480347),
		zoom: 2,
		scrollwheel: false,
		mapTypeControl: true,
		streetViewControl: false,
		panControl: false,
		zoomControl: true,
		zoomControlOptions: {
		    style: google.maps.ZoomControlStyle.SMALL
		},
        mapTypeId: google.maps.MapTypeId.<?php echo esc_js($map_type) ?>,
		styles: customStyle,
    };		

    <?php 
			if (!empty($marker)) { 
				$marker_src = wp_get_attachment_image_src( $marker, 'full' );
				?>
				var customMarker = {
					url: '<?php echo esc_url($marker_src[0]) ?>',
				};
	<?php } ?>

    map = new google.maps.Map(document.getElementById('map-canvas-<?php echo esc_js($map_id) ?>'), myOptions);

	<?php 
	if (!empty($address)) {
		$adresses = explode("|",$address);
		echo 'var locationsArray = [';
		foreach ($adresses as $location) {
			echo '[\''.esc_js($location).'\',\''.esc_js($location).'\'],';
		}
		echo '];';
	}
	?>

	function plotMarkers(){
	    var i;
	    for(i = 0; i < locationsArray.length; i++){
	        codeAddresses(locationsArray[i]);
	    }
	}

	function codeAddresses(address){
	    geocoder.geocode( { 'address': address[1]}, function(results, status) { 
	        if (status == google.maps.GeocoderStatus.OK) {
	            marker = new google.maps.Marker({
	                map: map,
	                position: results[0].geometry.location,
					<?php echo (!empty($marker)) ? 'icon: customMarker,' : '' ?>
	            });

	            google.maps.event.addListener(marker, 'click', function() {
	                // infowindow.setContent(address[0]);
	                infowindow.setContent('<a href="https://www.google.com/maps?q='+address[0]+'" target="_blank">'+address[0]+'</a>');
	                infowindow.open(map, this);
	            });

	            bounds.extend(results[0].geometry.location);

	            markersArray.push(marker); 
	        }
	        else{
	            console.log("Geocode was not successful for the following reason: " + status);
	        }
	        
	        map.fitBounds(bounds);
	        <?php if ($zoom != 'autozoom') { ?>
	        // if (locationsArray.length == 1) {
		        zoomChangeBoundsListener = 
				    google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
				        if (this.getZoom()){
				            this.setZoom(<?php echo esc_js($zoom) ?>);
				        }
				});
				setTimeout(function(){google.maps.event.removeListener(zoomChangeBoundsListener)}, 2000);
	        // }
	        <?php } ?>
	    });
	}

    plotMarkers();
}
google.maps.event.addDomListener(window, 'load', map_<?php echo esc_js($map_id) ?>);
</script>