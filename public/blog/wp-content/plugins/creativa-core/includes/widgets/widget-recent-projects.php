<?php
/**
 * Plugin Name: Recent Projects Widget
 * Description: A widget that displays Tab with recent/popular posts and recent comments.
 * Version: 1.0
 * Author: LeopardThemes
 */


add_action( 'widgets_init', 'creativa_recent_projects' );


function creativa_recent_projects() {
	register_widget( 'Creativa_Recent_Projects' );
}


class Creativa_Recent_Projects extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_projects', 'description' => esc_html__('A widget that displays recent projects. ', 'creativa') );
		parent::__construct('recent-projects', esc_html__('Creativa - Recent Projects', 'creativa'), $widget_ops);
		$this->alt_option_name = 'recent_projects';
	}

	function widget($args, $instance) {
		global $creativa_options;

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_projects', 'widget' );
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

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Projects', 'creativa' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number_recent_projects = ( ! empty( $instance['number_recent_projects'] ) ) ? absint( $instance['number_recent_projects'] ) : 4;
		if ( ! $number_recent_projects )
			$number_recent_projects = 4;


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
				$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			          'posts_per_page' => $number_recent_projects,
			          'post_type' => 'portfolio',
				) ) );

				if ($r->have_posts()) :
			?>

			<ul class="recent_project">
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li>
						<div class="widget-portfolio-item">
							<a href="<?php the_permalink(); ?>">   

								<?php 
							    $project_gallery = $creativa_options['opt-meta-project-gallery']; 
							    $project_attachments = explode(',', $project_gallery);

							    if (has_post_thumbnail()) { 
							      $thumb = get_post_thumbnail_id();
							      $img_url = wp_get_attachment_image_src( $thumb, 'thumbnail' ); //get full URL to image (use "large" or "medium" if the images too big)
							      echo '<img class="project-thmb" src="'. esc_url($img_url[0]) .'" width="'. esc_attr($img_url[1]) .'" height="'. esc_attr($img_url[2]) .'" alt="'. esc_attr__('Project Thumbnail', 'creativa') .'" />';
							    }
							    elseif ($project_gallery) {
							      $img_url = wp_get_attachment_image_src($project_attachments[0], 'thumbnail');
							      echo '<img class="project-thmb" src="'. esc_url($img_url[0]) .'" width="'. esc_attr($img_url[1]) .'" height="'. esc_attr($img_url[2]) .'" alt="'. esc_attr__('Project Thumbnail', 'creativa') .'" />';
							    }
								?>

				               	<div class="overlay">
				               		<div class="see-more"><h4 class="recent_project__title"><?php get_the_title() ? the_title() : the_ID(); ?></h4></div>
				               	</div>
							</a>
						</div>
					</li>
				<?php endwhile; endif; ?>
			</ul>

			<?php wp_reset_postdata(); ?>




		<?php echo ''.$after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_projects', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_recent_projects'] = (int) $new_instance['number_recent_projects'];

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_projects']) )
			delete_option('widget_recent_projects');

		return $instance;
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number_recent_projects    = isset( $instance['number_recent_projects'] ) ? absint( $instance['number_recent_projects'] ) : 4;

?>
		<p><label for="<?php echo ''.$this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'creativa' ); ?></label>
		<input class="widefat" id="<?php echo ''.$this->get_field_id( 'title' ); ?>" name="<?php echo ''.$this->get_field_name( 'title' ); ?>" type="text" value="<?php echo ''.$title; ?>" /></p>

		<p><label for="<?php echo ''.$this->get_field_id( 'number_recent_projects' ); ?>"><?php esc_html_e( 'Number of projects to show:', 'creativa' ); ?></label>
		<input id="<?php echo ''.$this->get_field_id( 'number_recent_projects' ); ?>" name="<?php echo ''.$this->get_field_name( 'number_recent_projects' ); ?>" type="text" value="<?php echo ''.$number_recent_projects; ?>" size="3" /></p>

<?php
	}
}


?>