<?php
$el_class = '';
extract(shortcode_atts(array(
  'el_class' => '',
  'icons_size' => 'si-normal ',
  'icons_position' => 'si-left ',
	'url_facebook' => '',
	'url_twitter' => '',
	'url_google_plus' => '',
	'url_flickr' => '',
	'url_linkedin' => '',
	'url_pinterest' => '',
	'url_instagram' => '',
	'url_behance' => '',
	'url_dribbble' => '',
	'url_tumblr' => '',
	'url_youtube' => '',
	'url_vimeo' => '',
	'url_vine' => '',
	'url_lastfm' => '',
	'url_deviantart' => '',
	'url_digg' => '',
	'url_dropbox' => '',
	'url_foursquare' => '',
	'url_github' => '',
	'url_reddit' => '',
	'url_skype' => '',
	'url_soundcloud' => '',
	'url_spotify' => '',
	'url_steam' => '',
	'url_stumbleupon' => '',
	'url_vk' => '',
	'url_wordpress' => '',
  'url_medium' => '',
  'url_twitch' => '',
  'url_whatsapp' => '',
  // 'color' => '', 
  'css' => '',
  'css_animation' => '',
  'css_animation_delay' => '',
), $atts));


?>
<div class="loprd-shortcode-social-icons <?php echo esc_attr($icons_position) .' '. creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
<?php 
echo '<ul class="social-icons '. esc_attr($icons_size) .'">';

if ($url_facebook) {
echo '<li class="facebook">
  <a href="'. esc_url($url_facebook) .'" target="_blank">
    <i class="fa fa-facebook"></i>
    <i class="fa fa-facebook"></i>
  </a>
</li>';
}

if ($url_twitter) {
echo '<li class="twitter">
  <a href="'. esc_url($url_twitter) .'" target="_blank">
    <i class="fa fa-twitter"></i>
    <i class="fa fa-twitter"></i>
  </a>
</li>';
}

if ($url_google_plus) {
echo '<li class="google-plus">
  <a href="'. esc_url($url_google_plus) .'" target="_blank">
    <i class="fa fa-google-plus"></i>
    <i class="fa fa-google-plus"></i>
  </a>
</li>';
}

if ($url_flickr) {
echo '<li class="flickr">
  <a href="'. esc_url($url_flickr) .'" target="_blank">
    <i class="fa fa-flickr"></i>
    <i class="fa fa-flickr"></i>
  </a>
</li>';
}

if ($url_linkedin) {
echo '<li class="linkedin">
  <a href="'. esc_url($url_linkedin) .'" target="_blank">
    <i class="fa fa-linkedin"></i>
    <i class="fa fa-linkedin"></i>
  </a>
</li>';
}

if ($url_pinterest) {
echo '<li class="pinterest">
  <a href="'. esc_url($url_pinterest) .'" target="_blank">
    <i class="fa fa-pinterest"></i>
    <i class="fa fa-pinterest"></i>
  </a>
</li>';
}

if ($url_instagram) {
echo '<li class="instagram">
  <a href="'. esc_url($url_instagram) .'" target="_blank">
    <i class="fa fa-instagram"></i>
    <i class="fa fa-instagram"></i>
  </a>
</li>';
}

if ($url_behance) {
echo '<li class="behance">
  <a href="'. esc_url($url_behance) .'" target="_blank">
    <i class="fa fa-behance"></i>
    <i class="fa fa-behance"></i>
  </a>
</li>';
}

if ($url_dribbble) {
echo '<li class="dribbble">
  <a href="'. esc_url($url_dribbble) .'" target="_blank">
    <i class="fa fa-dribbble"></i>
    <i class="fa fa-dribbble"></i>
  </a>
</li>';
}

if ($url_tumblr) {
echo '<li class="tumblr">
  <a href="'. esc_url($url_tumblr) .'" target="_blank">
    <i class="fa fa-tumblr"></i>
    <i class="fa fa-tumblr"></i>
  </a>
</li>';
}

if ($url_youtube) {
echo '<li class="youtube">
  <a href="'. esc_url($url_youtube) .'" target="_blank">
    <i class="fa fa-youtube"></i>
    <i class="fa fa-youtube"></i>
  </a>
</li>';
}

if ($url_vimeo) {
echo '<li class="vimeo-square">
  <a href="'. esc_url($url_vimeo) .'" target="_blank">
    <i class="fa fa-vimeo-square"></i>
    <i class="fa fa-vimeo-square"></i>
  </a>
</li>';
}

if ($url_vine) {
echo '<li class="vine">
  <a href="'. esc_url($url_vine) .'" target="_blank">
    <i class="fa fa-vine"></i>
    <i class="fa fa-vine"></i>
  </a>
</li>';
}

if ($url_lastfm) {
echo '<li class="lastfm">
  <a href="'. esc_url($url_lastfm) .'" target="_blank">
    <i class="fa fa-lastfm"></i>
    <i class="fa fa-lastfm"></i>
  </a>
</li>';
}

if ($url_deviantart) {
echo '<li class="deviantart">
  <a href="'. esc_url($url_deviantart) .'" target="_blank">
    <i class="fa fa-deviantart"></i>
    <i class="fa fa-deviantart"></i>
  </a>
</li>';
}

if ($url_digg) {
echo '<li class="digg">
  <a href="'. esc_url($url_digg) .'" target="_blank">
    <i class="fa fa-digg"></i>
    <i class="fa fa-digg"></i>
  </a>
</li>';
}

if ($url_dropbox) {
echo '<li class="dropbox">
  <a href="'. esc_url($url_dropbox) .'" target="_blank">
    <i class="fa fa-dropbox"></i>
    <i class="fa fa-dropbox"></i>
  </a>
</li>';
}

if ($url_foursquare) {
echo '<li class="foursquare">
  <a href="'. esc_url($url_foursquare) .'" target="_blank">
    <i class="fa fa-foursquare"></i>
    <i class="fa fa-foursquare"></i>
  </a>
</li>';
}

if ($url_github) {
echo '<li class="github">
  <a href="'. esc_url($url_github) .'" target="_blank">
    <i class="fa fa-github"></i>
    <i class="fa fa-github"></i>
  </a>
</li>';
}

if ($url_reddit) {
echo '<li class="reddit">
  <a href="'. esc_url($url_reddit) .'" target="_blank">
    <i class="fa fa-reddit"></i>
    <i class="fa fa-reddit"></i>
  </a>
</li>';
}

if ($url_skype) {
echo '<li class="skype">
  <a href="'. esc_url($url_skype) .'" target="_blank">
    <i class="fa fa-skype"></i>
    <i class="fa fa-skype"></i>
  </a>
</li>';
}

if ($url_soundcloud) {
echo '<li class="soundcloud">
  <a href="'. esc_url($url_soundcloud) .'" target="_blank">
    <i class="fa fa-soundcloud"></i>
    <i class="fa fa-soundcloud"></i>
  </a>
</li>';
}

if ($url_spotify) {
echo '<li class="spotify">
  <a href="'. esc_url($url_spotify) .'" target="_blank">
    <i class="fa fa-spotify"></i>
    <i class="fa fa-spotify"></i>
  </a>
</li>';
}

if ($url_steam) {
echo '<li class="steam">
  <a href="'. esc_url($url_steam) .'" target="_blank">
    <i class="fa fa-steam"></i>
    <i class="fa fa-steam"></i>
  </a>
</li>';
}

if ($url_stumbleupon) {
echo '<li class="stumbleupon">
  <a href="'. esc_url($url_stumbleupon) .'" target="_blank">
    <i class="fa fa-stumbleupon"></i>
    <i class="fa fa-stumbleupon"></i>
  </a>
</li>';
}

if ($url_vk) {
echo '<li class="vk">
  <a href="'. esc_url($url_vk) .'" target="_blank">
    <i class="fa fa-vk"></i>
    <i class="fa fa-vk"></i>
  </a>
</li>';
}

if ($url_wordpress) {
echo '<li class="wordpress">
  <a href="'. esc_url($url_wordpress) .'" target="_blank">
    <i class="fa fa-wordpress"></i>
    <i class="fa fa-wordpress"></i>
  </a>
</li>';
}

if ($url_medium) {
echo '<li class="medium">
  <a href="'. esc_url($url_medium) .'" target="_blank">
    <i class="fa fa-medium"></i>
    <i class="fa fa-medium"></i>
  </a>
</li>';
}

if ($url_twitch) {
echo '<li class="twitch">
  <a href="'. esc_url($url_twitch) .'" target="_blank">
    <i class="fa fa-twitch"></i>
    <i class="fa fa-twitch"></i>
  </a>
</li>';
}

if ($url_whatsapp) {
echo '<li class="whatsapp">
  <a href="'. esc_url($url_whatsapp) .'" target="_blank">
    <i class="fa fa-whatsapp"></i>
    <i class="fa fa-whatsapp"></i>
  </a>
</li>';
}

echo '</ul>';  
?>
</div>