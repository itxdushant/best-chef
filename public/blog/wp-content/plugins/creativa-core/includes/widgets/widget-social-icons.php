<?php
/**
 * Plugin Name: Social Icons Widget
 * Description: A widget that displays social icons.
 * Version: 1.0
 * Author: LeopardThemes
 */


add_action( 'widgets_init', 'creativa_social_icons' );


function creativa_social_icons() {
	register_widget( 'Creativa_Social_Icons' );
}


class Creativa_Social_Icons extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_social_icons', 'description' => esc_html__('A widget that displays social icons. ', 'creativa') );
		parent::__construct('social-icons', esc_html__('Creativa - Social Icons', 'creativa'), $widget_ops);
		$this->alt_option_name = 'recent_projects';
	}

	function widget($args, $instance) {

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_social_icons', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo ''.$cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Social Icons', 'creativa' );

		$url_facebook = ! empty( $instance['url_facebook'] ) ? $instance['url_facebook'] : '';
		while ( stristr($url_facebook, 'http') != $url_facebook )
			$url_facebook = substr($url_facebook, 1);

		$url_twitter = ! empty( $instance['url_twitter'] ) ? $instance['url_twitter'] : '';
		while ( stristr($url_twitter, 'http') != $url_twitter )
			$url_twitter = substr($url_twitter, 1);

		$url_google_plus = ! empty( $instance['url_google_plus'] ) ? $instance['url_google_plus'] : '';
		while ( stristr($url_google_plus, 'http') != $url_google_plus )
			$url_google_plus = substr($url_google_plus, 1);

		$url_flickr = ! empty( $instance['url_flickr'] ) ? $instance['url_flickr'] : '';
		while ( stristr($url_flickr, 'http') != $url_flickr )
			$url_flickr = substr($url_flickr, 1);

		$url_linkedin = ! empty( $instance['url_linkedin'] ) ? $instance['url_linkedin'] : '';
		while ( stristr($url_linkedin, 'http') != $url_linkedin )
			$url_linkedin = substr($url_linkedin, 1);

		$url_pinterest = ! empty( $instance['url_pinterest'] ) ? $instance['url_pinterest'] : '';
		while ( stristr($url_pinterest, 'http') != $url_pinterest )
			$url_pinterest = substr($url_pinterest, 1);

		$url_instagram = ! empty( $instance['url_instagram'] ) ? $instance['url_instagram'] : '';
		while ( stristr($url_instagram, 'http') != $url_instagram )
			$url_instagram = substr($url_instagram, 1);

		$url_behance = ! empty( $instance['url_behance'] ) ? $instance['url_behance'] : '';
		while ( stristr($url_behance, 'http') != $url_behance )
			$url_behance = substr($url_behance, 1);

		$url_dribbble = ! empty( $instance['url_dribbble'] ) ? $instance['url_dribbble'] : '';
		while ( stristr($url_dribbble, 'http') != $url_dribbble )
			$url_dribbble = substr($url_dribbble, 1);

		$url_tumblr = ! empty( $instance['url_tumblr'] ) ? $instance['url_tumblr'] : '';
		while ( stristr($url_tumblr, 'http') != $url_tumblr )
			$url_tumblr = substr($url_tumblr, 1);

		$url_youtube = ! empty( $instance['url_youtube'] ) ? $instance['url_youtube'] : '';
		while ( stristr($url_youtube, 'http') != $url_youtube )
			$url_youtube = substr($url_youtube, 1);

		$url_vimeo = ! empty( $instance['url_vimeo'] ) ? $instance['url_vimeo'] : '';
		while ( stristr($url_vimeo, 'http') != $url_vimeo )
			$url_vimeo = substr($url_vimeo, 1);

		$url_vine = ! empty( $instance['url_vine'] ) ? $instance['url_vine'] : '';
		while ( stristr($url_vine, 'http') != $url_vine )
			$url_vine = substr($url_vine, 1);

		$url_lastfm = ! empty( $instance['url_lastfm'] ) ? $instance['url_lastfm'] : '';
		while ( stristr($url_lastfm, 'http') != $url_lastfm )
			$url_lastfm = substr($url_lastfm, 1);

		$url_deviantart = ! empty( $instance['url_deviantart'] ) ? $instance['url_deviantart'] : '';
		while ( stristr($url_deviantart, 'http') != $url_deviantart )
			$url_deviantart = substr($url_deviantart, 1);

		$url_digg = ! empty( $instance['url_digg'] ) ? $instance['url_digg'] : '';
		while ( stristr($url_digg, 'http') != $url_digg )
			$url_digg = substr($url_digg, 1);

		$url_dropbox = ! empty( $instance['url_dropbox'] ) ? $instance['url_dropbox'] : '';
		while ( stristr($url_dropbox, 'http') != $url_dropbox )
			$url_dropbox = substr($url_dropbox, 1);

		$url_foursquare = ! empty( $instance['url_foursquare'] ) ? $instance['url_foursquare'] : '';
		while ( stristr($url_foursquare, 'http') != $url_foursquare )
			$url_foursquare = substr($url_foursquare, 1);

		$url_github = ! empty( $instance['url_github'] ) ? $instance['url_github'] : '';
		while ( stristr($url_github, 'http') != $url_github )
			$url_github = substr($url_github, 1);

		$url_reddit = ! empty( $instance['url_reddit'] ) ? $instance['url_reddit'] : '';
		while ( stristr($url_reddit, 'http') != $url_reddit )
			$url_reddit = substr($url_reddit, 1);

		$url_skype = ! empty( $instance['url_skype'] ) ? $instance['url_skype'] : '';
		while ( stristr($url_skype, 'http') != $url_skype )
			$url_skype = substr($url_skype, 1);

		$url_soundcloud = ! empty( $instance['url_soundcloud'] ) ? $instance['url_soundcloud'] : '';
		while ( stristr($url_soundcloud, 'http') != $url_soundcloud )
			$url_soundcloud = substr($url_soundcloud, 1);

		$url_spotify = ! empty( $instance['url_spotify'] ) ? $instance['url_spotify'] : '';
		while ( stristr($url_spotify, 'http') != $url_spotify )
			$url_spotify = substr($url_spotify, 1);

		$url_steam = ! empty( $instance['url_steam'] ) ? $instance['url_steam'] : '';
		while ( stristr($url_steam, 'http') != $url_steam )
			$url_steam = substr($url_steam, 1);

		$url_stumbleupon = ! empty( $instance['url_stumbleupon'] ) ? $instance['url_stumbleupon'] : '';
		while ( stristr($url_stumbleupon, 'http') != $url_stumbleupon )
			$url_stumbleupon = substr($url_stumbleupon, 1);

		$url_vk = ! empty( $instance['url_vk'] ) ? $instance['url_vk'] : '';
		while ( stristr($url_vk, 'http') != $url_vk )
			$url_vk = substr($url_vk, 1);

		$url_wordpress = ! empty( $instance['url_wordpress'] ) ? $instance['url_wordpress'] : '';
		while ( stristr($url_wordpress, 'http') != $url_wordpress )
			$url_wordpress = substr($url_wordpress, 1);

		$url_medium = ! empty( $instance['url_medium'] ) ? $instance['url_medium'] : '';
		while ( stristr($url_medium, 'http') != $url_medium )
			$url_medium = substr($url_medium, 1);

		$url_twitch = ! empty( $instance['url_twitch'] ) ? $instance['url_twitch'] : '';
		while ( stristr($url_twitch, 'http') != $url_twitch )
			$url_twitch = substr($url_twitch, 1);

		$url_whatsapp = ! empty( $instance['url_whatsapp'] ) ? $instance['url_whatsapp'] : '';
		while ( stristr($url_whatsapp, 'http') != $url_whatsapp )
			$url_whatsapp = substr($url_whatsapp, 1);

		// if ( empty($url_facebook) )
		// 	return '';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$url_facebook = esc_url(strip_tags($url_facebook));
		$url_twitter = esc_url(strip_tags($url_twitter));
		$url_google_plus = esc_url(strip_tags($url_google_plus));
		$url_flickr = esc_url(strip_tags($url_flickr));
		$url_linkedin = esc_url(strip_tags($url_linkedin));
		$url_pinterest = esc_url(strip_tags($url_pinterest));
		$url_instagram = esc_url(strip_tags($url_instagram));
		$url_behance = esc_url(strip_tags($url_behance));
		$url_dribbble = esc_url(strip_tags($url_dribbble));
		$url_tumblr = esc_url(strip_tags($url_tumblr));
		$url_youtube = esc_url(strip_tags($url_youtube));
		$url_vimeo = esc_url(strip_tags($url_vimeo));
		$url_vine = esc_url(strip_tags($url_vine));
		$url_lastfm = esc_url(strip_tags($url_lastfm));
		$url_deviantart = esc_url(strip_tags($url_deviantart));
		$url_digg = esc_url(strip_tags($url_digg));
		$url_dropbox = esc_url(strip_tags($url_dropbox));
		$url_foursquare = esc_url(strip_tags($url_foursquare));
		$url_github = esc_url(strip_tags($url_github));
		$url_reddit = esc_url(strip_tags($url_reddit));
		$url_skype = esc_url(strip_tags($url_skype));
		$url_soundcloud = esc_url(strip_tags($url_soundcloud));
		$url_spotify = esc_url(strip_tags($url_spotify));
		$url_steam = esc_url(strip_tags($url_steam));
		$url_stumbleupon = esc_url(strip_tags($url_stumbleupon));
		$url_vk = esc_url(strip_tags($url_vk));
		$url_wordpress = esc_url(strip_tags($url_wordpress));
		$url_medium = esc_url(strip_tags($url_medium));
		$url_twitch = esc_url(strip_tags($url_twitch));
		$url_whatsapp = esc_url(strip_tags($url_whatsapp));


		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */


?>
		<?php echo ''.$before_widget; ?>
		<?php if ( $title ) echo ''.$before_title . $title . $after_title; ?>


		<?php 

		  echo '<ul class="social-icons">';

		  if ($url_facebook) {
		    echo '<li class="facebook">
		      <a href="'. $url_facebook .'" target="_blank">
		        <i class="fa fa-facebook"></i>
		        <i class="fa fa-facebook"></i>
		      </a>
		    </li>';
		  }

		  if ($url_twitter) {
		    echo '<li class="twitter">
		      <a href="'. $url_twitter .'" target="_blank">
		        <i class="fa fa-twitter"></i>
		        <i class="fa fa-twitter"></i>
		      </a>
		    </li>';
		  }

		  if ($url_google_plus) {
		    echo '<li class="google-plus">
		      <a href="'. $url_google_plus .'" target="_blank">
		        <i class="fa fa-google-plus"></i>
		        <i class="fa fa-google-plus"></i>
		      </a>
		    </li>';
		  }

		  if ($url_flickr) {
		    echo '<li class="flickr">
		      <a href="'. $url_flickr .'" target="_blank">
		        <i class="fa fa-flickr"></i>
		        <i class="fa fa-flickr"></i>
		      </a>
		    </li>';
		  }

		  if ($url_linkedin) {
		    echo '<li class="linkedin">
		      <a href="'. $url_linkedin .'" target="_blank">
		        <i class="fa fa-linkedin"></i>
		        <i class="fa fa-linkedin"></i>
		      </a>
		    </li>';
		  }

		  if ($url_pinterest) {
		    echo '<li class="pinterest">
		      <a href="'. $url_pinterest .'" target="_blank">
		        <i class="fa fa-pinterest"></i>
		        <i class="fa fa-pinterest"></i>
		      </a>
		    </li>';
		  }

		  if ($url_instagram) {
		    echo '<li class="instagram">
		      <a href="'. $url_instagram .'" target="_blank">
		        <i class="fa fa-instagram"></i>
		        <i class="fa fa-instagram"></i>
		      </a>
		    </li>';
		  }

		  if ($url_behance) {
		    echo '<li class="behance">
		      <a href="'. $url_behance .'" target="_blank">
		        <i class="fa fa-behance"></i>
		        <i class="fa fa-behance"></i>
		      </a>
		    </li>';
		  }

		  if ($url_dribbble) {
		    echo '<li class="dribbble">
		      <a href="'. $url_dribbble .'" target="_blank">
		        <i class="fa fa-dribbble"></i>
		        <i class="fa fa-dribbble"></i>
		      </a>
		    </li>';
		  }

		  if ($url_tumblr) {
		    echo '<li class="tumblr">
		      <a href="'. $url_tumblr .'" target="_blank">
		        <i class="fa fa-tumblr"></i>
		        <i class="fa fa-tumblr"></i>
		      </a>
		    </li>';
		  }

		  if ($url_youtube) {
		    echo '<li class="youtube">
		      <a href="'. $url_youtube .'" target="_blank">
		        <i class="fa fa-youtube"></i>
		        <i class="fa fa-youtube"></i>
		      </a>
		    </li>';
		  }

		  if ($url_vimeo) {
		    echo '<li class="vimeo-square">
		      <a href="'. $url_vimeo .'" target="_blank">
		        <i class="fa fa-vimeo-square"></i>
		        <i class="fa fa-vimeo-square"></i>
		      </a>
		    </li>';
		  }

		  if ($url_vine) {
		    echo '<li class="vine">
		      <a href="'. $url_vine .'" target="_blank">
		        <i class="fa fa-vine"></i>
		        <i class="fa fa-vine"></i>
		      </a>
		    </li>';
		  }

		  if ($url_lastfm) {
		    echo '<li class="lastfm">
		      <a href="'. $url_lastfm .'" target="_blank">
		        <i class="fa fa-lastfm"></i>
		        <i class="fa fa-lastfm"></i>
		      </a>
		    </li>';
		  }

		  if ($url_deviantart) {
		    echo '<li class="deviantart">
		      <a href="'. $url_deviantart .'" target="_blank">
		        <i class="fa fa-deviantart"></i>
		        <i class="fa fa-deviantart"></i>
		      </a>
		    </li>';
		  }

		  if ($url_digg) {
		    echo '<li class="digg">
		      <a href="'. $url_digg .'" target="_blank">
		        <i class="fa fa-digg"></i>
		        <i class="fa fa-digg"></i>
		      </a>
		    </li>';
		  }

		  if ($url_dropbox) {
		    echo '<li class="dropbox">
		      <a href="'. $url_dropbox .'" target="_blank">
		        <i class="fa fa-dropbox"></i>
		        <i class="fa fa-dropbox"></i>
		      </a>
		    </li>';
		  }

		  if ($url_foursquare) {
		    echo '<li class="foursquare">
		      <a href="'. $url_foursquare .'" target="_blank">
		        <i class="fa fa-foursquare"></i>
		        <i class="fa fa-foursquare"></i>
		      </a>
		    </li>';
		  }

		  if ($url_github) {
		    echo '<li class="github">
		      <a href="'. $url_github .'" target="_blank">
		        <i class="fa fa-github"></i>
		        <i class="fa fa-github"></i>
		      </a>
		    </li>';
		  }

		  if ($url_reddit) {
		    echo '<li class="reddit">
		      <a href="'. $url_reddit .'" target="_blank">
		        <i class="fa fa-reddit"></i>
		        <i class="fa fa-reddit"></i>
		      </a>
		    </li>';
		  }

		  if ($url_skype) {
		    echo '<li class="skype">
		      <a href="'. $url_skype .'" target="_blank">
		        <i class="fa fa-skype"></i>
		        <i class="fa fa-skype"></i>
		      </a>
		    </li>';
		  }

		  if ($url_soundcloud) {
		    echo '<li class="soundcloud">
		      <a href="'. $url_soundcloud .'" target="_blank">
		        <i class="fa fa-soundcloud"></i>
		        <i class="fa fa-soundcloud"></i>
		      </a>
		    </li>';
		  }

		  if ($url_spotify) {
		    echo '<li class="spotify">
		      <a href="'. $url_spotify .'" target="_blank">
		        <i class="fa fa-spotify"></i>
		        <i class="fa fa-spotify"></i>
		      </a>
		    </li>';
		  }

		  if ($url_steam) {
		    echo '<li class="steam">
		      <a href="'. $url_steam .'" target="_blank">
		        <i class="fa fa-steam"></i>
		        <i class="fa fa-steam"></i>
		      </a>
		    </li>';
		  }

		  if ($url_stumbleupon) {
		    echo '<li class="stumbleupon">
		      <a href="'. $url_stumbleupon .'" target="_blank">
		        <i class="fa fa-stumbleupon"></i>
		        <i class="fa fa-stumbleupon"></i>
		      </a>
		    </li>';
		  }

		  if ($url_vk) {
		    echo '<li class="vk">
		      <a href="'. $url_vk .'" target="_blank">
		        <i class="fa fa-vk"></i>
		        <i class="fa fa-vk"></i>
		      </a>
		    </li>';
		  }

		  if ($url_wordpress) {
		    echo '<li class="wordpress">
		      <a href="'. $url_wordpress .'" target="_blank">
		        <i class="fa fa-wordpress"></i>
		        <i class="fa fa-wordpress"></i>
		      </a>
		    </li>';
		  }

		  if ($url_medium) {
		    echo '<li class="medium">
		      <a href="'. $url_medium .'" target="_blank">
		        <i class="fa fa-medium"></i>
		        <i class="fa fa-medium"></i>
		      </a>
		    </li>';
		  }

		  if ($url_twitch) {
		    echo '<li class="twitch">
		      <a href="'. $url_twitch .'" target="_blank">
		        <i class="fa fa-twitch"></i>
		        <i class="fa fa-twitch"></i>
		      </a>
		    </li>';
		  }

		  if ($url_whatsapp) {
		    echo '<li class="whatsapp">
		      <a href="'. $url_whatsapp .'" target="_blank">
		        <i class="fa fa-whatsapp"></i>
		        <i class="fa fa-whatsapp"></i>
		      </a>
		    </li>';
		  }

		  echo '</ul>';  
		  ?>




		<?php echo ''.$after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		//wp_reset_postdata();

		// endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_social_icons', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['url_facebook'] = strip_tags($new_instance['url_facebook']);
		$instance['url_twitter'] = strip_tags($new_instance['url_twitter']);
		$instance['url_google_plus'] = strip_tags($new_instance['url_google_plus']);
		$instance['url_flickr'] = strip_tags($new_instance['url_flickr']);
		$instance['url_linkedin'] = strip_tags($new_instance['url_linkedin']);
		$instance['url_pinterest'] = strip_tags($new_instance['url_pinterest']);
		$instance['url_instagram'] = strip_tags($new_instance['url_instagram']);
		$instance['url_behance'] = strip_tags($new_instance['url_behance']);
		$instance['url_dribbble'] = strip_tags($new_instance['url_dribbble']);
		$instance['url_tumblr'] = strip_tags($new_instance['url_tumblr']);
		$instance['url_youtube'] = strip_tags($new_instance['url_youtube']);
		$instance['url_vimeo'] = strip_tags($new_instance['url_vimeo']);
		$instance['url_vine'] = strip_tags($new_instance['url_vine']);
		$instance['url_lastfm'] = strip_tags($new_instance['url_lastfm']);
		$instance['url_deviantart'] = strip_tags($new_instance['url_deviantart']);
		$instance['url_digg'] = strip_tags($new_instance['url_digg']);
		$instance['url_dropbox'] = strip_tags($new_instance['url_dropbox']);
		$instance['url_foursquare'] = strip_tags($new_instance['url_foursquare']);
		$instance['url_github'] = strip_tags($new_instance['url_github']);
		$instance['url_reddit'] = strip_tags($new_instance['url_reddit']);
		$instance['url_skype'] = strip_tags($new_instance['url_skype']);
		$instance['url_soundcloud'] = strip_tags($new_instance['url_soundcloud']);
		$instance['url_spotify'] = strip_tags($new_instance['url_spotify']);
		$instance['url_steam'] = strip_tags($new_instance['url_steam']);
		$instance['url_stumbleupon'] = strip_tags($new_instance['url_stumbleupon']);
		$instance['url_vk'] = strip_tags($new_instance['url_vk']);
		$instance['url_wordpress'] = strip_tags($new_instance['url_wordpress']);
		$instance['url_medium'] = strip_tags($new_instance['url_medium']);
		$instance['url_twitch'] = strip_tags($new_instance['url_twitch']);
		$instance['url_whatsapp'] = strip_tags($new_instance['url_whatsapp']);

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_social_icons']) )
			delete_option('widget_social_icons');

		return $instance;
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$url_facebook     = isset( $instance['url_facebook'] ) ? esc_attr( $instance['url_facebook'] ) : '';
		$url_twitter     = isset( $instance['url_twitter'] ) ? esc_attr( $instance['url_twitter'] ) : '';
		$url_google_plus     = isset( $instance['url_google_plus'] ) ? esc_attr( $instance['url_google_plus'] ) : '';
		$url_flickr     = isset( $instance['url_flickr'] ) ? esc_attr( $instance['url_flickr'] ) : '';
		$url_linkedin     = isset( $instance['url_linkedin'] ) ? esc_attr( $instance['url_linkedin'] ) : '';
		$url_pinterest     = isset( $instance['url_pinterest'] ) ? esc_attr( $instance['url_pinterest'] ) : '';
		$url_instagram     = isset( $instance['url_instagram'] ) ? esc_attr( $instance['url_instagram'] ) : '';
		$url_behance     = isset( $instance['url_behance'] ) ? esc_attr( $instance['url_behance'] ) : '';
		$url_dribbble     = isset( $instance['url_dribbble'] ) ? esc_attr( $instance['url_dribbble'] ) : '';
		$url_tumblr     = isset( $instance['url_tumblr'] ) ? esc_attr( $instance['url_tumblr'] ) : '';
		$url_youtube     = isset( $instance['url_youtube'] ) ? esc_attr( $instance['url_youtube'] ) : '';
		$url_vimeo     = isset( $instance['url_vimeo'] ) ? esc_attr( $instance['url_vimeo'] ) : '';
		$url_vine     = isset( $instance['url_vine'] ) ? esc_attr( $instance['url_vine'] ) : '';
		$url_lastfm     = isset( $instance['url_lastfm'] ) ? esc_attr( $instance['url_lastfm'] ) : '';
		$url_deviantart     = isset( $instance['url_deviantart'] ) ? esc_attr( $instance['url_deviantart'] ) : '';
		$url_digg     = isset( $instance['url_digg'] ) ? esc_attr( $instance['url_digg'] ) : '';
		$url_dropbox     = isset( $instance['url_dropbox'] ) ? esc_attr( $instance['url_dropbox'] ) : '';
		$url_foursquare     = isset( $instance['url_foursquare'] ) ? esc_attr( $instance['url_foursquare'] ) : '';
		$url_github     = isset( $instance['url_github'] ) ? esc_attr( $instance['url_github'] ) : '';
		$url_reddit     = isset( $instance['url_reddit'] ) ? esc_attr( $instance['url_reddit'] ) : '';
		$url_skype     = isset( $instance['url_skype'] ) ? esc_attr( $instance['url_skype'] ) : '';
		$url_soundcloud     = isset( $instance['url_soundcloud'] ) ? esc_attr( $instance['url_soundcloud'] ) : '';
		$url_spotify     = isset( $instance['url_spotify'] ) ? esc_attr( $instance['url_spotify'] ) : '';
		$url_steam     = isset( $instance['url_steam'] ) ? esc_attr( $instance['url_steam'] ) : '';
		$url_stumbleupon     = isset( $instance['url_stumbleupon'] ) ? esc_attr( $instance['url_stumbleupon'] ) : '';
		$url_vk     = isset( $instance['url_vk'] ) ? esc_attr( $instance['url_vk'] ) : '';
		$url_wordpress     = isset( $instance['url_wordpress'] ) ? esc_attr( $instance['url_wordpress'] ) : '';
		$url_medium     = isset( $instance['url_medium'] ) ? esc_attr( $instance['url_medium'] ) : '';
		$url_twitch     = isset( $instance['url_twitch'] ) ? esc_attr( $instance['url_twitch'] ) : '';
		$url_whatsapp     = isset( $instance['url_whatsapp'] ) ? esc_attr( $instance['url_whatsapp'] ) : '';

?>
		<p><label for="<?php echo ''.$this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title (optional)', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'title' ); ?>" name="<?php echo ''.$this->get_field_name( 'title' ); ?>" type="text" value="<?php echo ''.$title; ?>" /></p>

		<p><?php esc_html_e('<strong>Important!</strong><br><strong>http://</strong> before url is required. <br><i>(e.g. http://facebook.com/yoursprofile)</i>', 'creativa') ?></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_facebook' ); ?>"><?php esc_html_e( 'Facebook Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_facebook' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_facebook' ); ?>" type="text" value="<?php echo esc_attr($url_facebook); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_twitter' ); ?>"><?php esc_html_e( 'Twitter Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_twitter' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_twitter' ); ?>" type="text" value="<?php echo esc_attr($url_twitter); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_google_plus' ); ?>"><?php esc_html_e( 'Google+ Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_google_plus' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_google_plus' ); ?>" type="text" value="<?php echo esc_attr($url_google_plus); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_flickr' ); ?>"><?php esc_html_e( 'Flickr Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_flickr' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_flickr' ); ?>" type="text" value="<?php echo esc_attr($url_flickr); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_linkedin' ); ?>"><?php esc_html_e( 'LinkedIn Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_linkedin' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_linkedin' ); ?>" type="text" value="<?php echo esc_attr($url_linkedin); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_pinterest' ); ?>"><?php esc_html_e( 'Pinterest Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_pinterest' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_pinterest' ); ?>" type="text" value="<?php echo esc_attr($url_pinterest); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_instagram' ); ?>"><?php esc_html_e( 'Instagram Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_instagram' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_instagram' ); ?>" type="text" value="<?php echo esc_attr($url_instagram); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_behance' ); ?>"><?php esc_html_e( 'Behance Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_behance' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_behance' ); ?>" type="text" value="<?php echo esc_attr($url_behance); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_dribbble' ); ?>"><?php esc_html_e( 'Dribbble Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_dribbble' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_dribbble' ); ?>" type="text" value="<?php echo esc_attr($url_dribbble); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_tumblr' ); ?>"><?php esc_html_e( 'Tumblr Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_tumblr' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_tumblr' ); ?>" type="text" value="<?php echo esc_attr($url_tumblr); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_youtube' ); ?>"><?php esc_html_e( 'YouTube Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_youtube' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_youtube' ); ?>" type="text" value="<?php echo esc_attr($url_youtube); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_vimeo' ); ?>"><?php esc_html_e( 'Vimeo Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_vimeo' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_vimeo' ); ?>" type="text" value="<?php echo esc_attr($url_vimeo); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_vine' ); ?>"><?php esc_html_e( 'Vine Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_vine' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_vine' ); ?>" type="text" value="<?php echo esc_attr($url_vine); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_lastfm' ); ?>"><?php esc_html_e( 'LastFM Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_lastfm' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_lastfm' ); ?>" type="text" value="<?php echo esc_attr($url_lastfm); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_deviantart' ); ?>"><?php esc_html_e( 'DeviantArt Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_deviantart' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_deviantart' ); ?>" type="text" value="<?php echo esc_attr($url_deviantart); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_digg' ); ?>"><?php esc_html_e( 'Digg Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_digg' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_digg' ); ?>" type="text" value="<?php echo esc_attr($url_digg); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_dropbox' ); ?>"><?php esc_html_e( 'Dropbox Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_dropbox' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_dropbox' ); ?>" type="text" value="<?php echo esc_attr($url_dropbox); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_foursquare' ); ?>"><?php esc_html_e( 'FourSquare Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_foursquare' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_foursquare' ); ?>" type="text" value="<?php echo esc_attr($url_foursquare); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_github' ); ?>"><?php esc_html_e( 'GitHub Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_github' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_github' ); ?>" type="text" value="<?php echo esc_attr($url_github); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_reddit' ); ?>"><?php esc_html_e( 'Reddit Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_reddit' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_reddit' ); ?>" type="text" value="<?php echo esc_attr($url_reddit); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_skype' ); ?>"><?php esc_html_e( 'Skype Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_skype' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_skype' ); ?>" type="text" value="<?php echo esc_attr($url_skype); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_soundcloud' ); ?>"><?php esc_html_e( 'SoundCloud Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_soundcloud' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_soundcloud' ); ?>" type="text" value="<?php echo esc_attr($url_soundcloud); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_spotify' ); ?>"><?php esc_html_e( 'Spotify Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_spotify' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_spotify' ); ?>" type="text" value="<?php echo esc_attr($url_spotify); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_steam' ); ?>"><?php esc_html_e( 'Steam Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_steam' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_steam' ); ?>" type="text" value="<?php echo esc_attr($url_steam); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_stumbleupon' ); ?>"><?php esc_html_e( 'StumbleUpon Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_stumbleupon' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_stumbleupon' ); ?>" type="text" value="<?php echo esc_attr($url_stumbleupon); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_vk' ); ?>"><?php esc_html_e( 'VK Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_vk' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_vk' ); ?>" type="text" value="<?php echo esc_attr($url_vk); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_wordpress' ); ?>"><?php esc_html_e( 'WordPress Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_wordpress' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_wordpress' ); ?>" type="text" value="<?php echo esc_attr($url_wordpress); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_medium' ); ?>"><?php esc_html_e( 'Medium Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_medium' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_medium' ); ?>" type="text" value="<?php echo esc_attr($url_medium); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_twitch' ); ?>"><?php esc_html_e( 'Twitch Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_twitch' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_twitch' ); ?>" type="text" value="<?php echo esc_attr($url_twitch); ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'url_whatsapp' ); ?>"><?php esc_html_e( 'WhatsApp Profile URL', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'url_whatsapp' ); ?>" name="<?php echo ''.$this->get_field_name( 'url_whatsapp' ); ?>" type="text" value="<?php echo esc_attr($url_whatsapp); ?>" /></p>

<?php
	}
}


?>