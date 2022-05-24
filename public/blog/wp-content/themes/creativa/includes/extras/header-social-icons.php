<?php 
function header_social_icons() {   

global $creativa_options; 

  echo '<ul class="social-icons">';

  if (!empty($creativa_options['opt-social-facebook-url'])) {
    echo '<li class="facebook">
      <a href="'. esc_url($creativa_options['opt-social-facebook-url']) .'" target="_blank">
        <i class="fa fa-facebook"></i><i class="fa fa-facebook"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-twitter-url'])) {
    echo '<li class="twitter">
      <a href="'. esc_url($creativa_options['opt-social-twitter-url']) .'" target="_blank">
        <i class="fa fa-twitter"></i>
        <i class="fa fa-twitter"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-google-plus-url'])) {
    echo '<li class="google-plus">
      <a href="'. esc_url($creativa_options['opt-social-google-plus-url']) .'" target="_blank">
        <i class="fa fa-google-plus"></i>
        <i class="fa fa-google-plus"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-flickr-url'])) {
    echo '<li class="flickr">
      <a href="'. esc_url($creativa_options['opt-social-flickr-url']) .'" target="_blank">
        <i class="fa fa-flickr"></i>
        <i class="fa fa-flickr"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-linkedin-url'])) {
    echo '<li class="linkedin">
      <a href="'. esc_url($creativa_options['opt-social-linkedin-url']) .'" target="_blank">
        <i class="fa fa-linkedin"></i>
        <i class="fa fa-linkedin"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-pinterest-url'])) {
    echo '<li class="pinterest">
      <a href="'. esc_url($creativa_options['opt-social-pinterest-url']) .'" target="_blank">
        <i class="fa fa-pinterest"></i>
        <i class="fa fa-pinterest"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-instagram-url'])) {
    echo '<li class="instagram">
      <a href="'. esc_url($creativa_options['opt-social-instagram-url']) .'" target="_blank">
        <i class="fa fa-instagram"></i>
        <i class="fa fa-instagram"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-behance-url'])) {
    echo '<li class="behance">
      <a href="'. esc_url($creativa_options['opt-social-behance-url']) .'" target="_blank">
        <i class="fa fa-behance"></i>
        <i class="fa fa-behance"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-dribbble-url'])) {
    echo '<li class="dribbble">
      <a href="'. esc_url($creativa_options['opt-social-dribbble-url']) .'" target="_blank">
        <i class="fa fa-dribbble"></i>
        <i class="fa fa-dribbble"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-tumblr-url'])) {
    echo '<li class="tumblr">
      <a href="'. esc_url($creativa_options['opt-social-tumblr-url']) .'" target="_blank">
        <i class="fa fa-tumblr"></i>
        <i class="fa fa-tumblr"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-youtube-url'])) {
    echo '<li class="youtube">
      <a href="'. esc_url($creativa_options['opt-social-youtube-url']) .'" target="_blank">
        <i class="fa fa-youtube"></i>
        <i class="fa fa-youtube"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-vimeo-url'])) {
    echo '<li class="vimeo-square">
      <a href="'. esc_url($creativa_options['opt-social-vimeo-url']) .'" target="_blank">
        <i class="fa fa-vimeo-square"></i>
        <i class="fa fa-vimeo-square"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-vine-url'])) {
    echo '<li class="vine">
      <a href="'. esc_url($creativa_options['opt-social-vine-url']) .'" target="_blank">
        <i class="fa fa-vine"></i>
        <i class="fa fa-vine"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-lastfm-url'])) {
    echo '<li class="lastfm">
      <a href="'. esc_url($creativa_options['opt-social-lastfm-url']) .'" target="_blank">
        <i class="fa fa-lastfm"></i>
        <i class="fa fa-lastfm"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-deviantart-url'])) {
    echo '<li class="deviantart">
      <a href="'. esc_url($creativa_options['opt-social-deviantart-url']) .'" target="_blank">
        <i class="fa fa-deviantart"></i>
        <i class="fa fa-deviantart"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-digg-url'])) {
    echo '<li class="digg">
      <a href="'. esc_url($creativa_options['opt-social-digg-url']) .'" target="_blank">
        <i class="fa fa-digg"></i>
        <i class="fa fa-digg"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-dropbox-url'])) {
    echo '<li class="dropbox">
      <a href="'. esc_url($creativa_options['opt-social-dropbox-url']) .'" target="_blank">
        <i class="fa fa-dropbox"></i>
        <i class="fa fa-dropbox"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-foursquare-url'])) {
    echo '<li class="foursquare">
      <a href="'. esc_url($creativa_options['opt-social-foursquare-url']) .'" target="_blank">
        <i class="fa fa-foursquare"></i>
        <i class="fa fa-foursquare"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-github-url'])) {
    echo '<li class="github">
      <a href="'. esc_url($creativa_options['opt-social-github-url']) .'" target="_blank">
        <i class="fa fa-github"></i>
        <i class="fa fa-github"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-reddit-url'])) {
    echo '<li class="reddit">
      <a href="'. esc_url($creativa_options['opt-social-reddit-url']) .'" target="_blank">
        <i class="fa fa-reddit"></i>
        <i class="fa fa-reddit"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-skype-url'])) {
    echo '<li class="skype">
      <a href="'. esc_url($creativa_options['opt-social-skype-url']) .'" target="_blank">
        <i class="fa fa-skype"></i>
        <i class="fa fa-skype"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-soundcloud-url'])) {
    echo '<li class="soundcloud">
      <a href="'. esc_url($creativa_options['opt-social-soundcloud-url']) .'" target="_blank">
        <i class="fa fa-soundcloud"></i>
        <i class="fa fa-soundcloud"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-spotify-url'])) {
    echo '<li class="spotify">
      <a href="'. esc_url($creativa_options['opt-social-spotify-url']) .'" target="_blank">
        <i class="fa fa-spotify"></i>
        <i class="fa fa-spotify"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-steam-url'])) {
    echo '<li class="steam">
      <a href="'. esc_url($creativa_options['opt-social-steam-url']) .'" target="_blank">
        <i class="fa fa-steam"></i>
        <i class="fa fa-steam"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-stumbleupon-url'])) {
    echo '<li class="stumbleupon">
      <a href="'. esc_url($creativa_options['opt-social-stumbleupon-url']) .'" target="_blank">
        <i class="fa fa-stumbleupon"></i>
        <i class="fa fa-stumbleupon"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-vk-url'])) {
    echo '<li class="vk">
      <a href="'. esc_url($creativa_options['opt-social-vk-url']) .'" target="_blank">
        <i class="fa fa-vk"></i>
        <i class="fa fa-vk"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-wordpress-url'])) {
    echo '<li class="wordpress">
      <a href="'. esc_url($creativa_options['opt-social-wordpress-url']) .'" target="_blank">
        <i class="fa fa-wordpress"></i>
        <i class="fa fa-wordpress"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-medium-url'])) {
    echo '<li class="medium">
      <a href="'. esc_url($creativa_options['opt-social-medium-url']) .'" target="_blank">
        <i class="fa fa-medium"></i>
        <i class="fa fa-medium"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-twitch-url'])) {
    echo '<li class="twitch">
      <a href="'. esc_url($creativa_options['opt-social-twitch-url']) .'" target="_blank">
        <i class="fa fa-twitch"></i>
        <i class="fa fa-twitch"></i>
      </a>
    </li>';
  }

  if (!empty($creativa_options['opt-social-whatsapp-url'])) {
    echo '<li class="whatsapp">
      <a href="'. esc_url($creativa_options['opt-social-whatsapp-url']) .'" target="_blank">
        <i class="fa fa-whatsapp"></i>
        <i class="fa fa-whatsapp"></i>
      </a>
    </li>';
  }

  echo '</ul>';  
  
}

?>