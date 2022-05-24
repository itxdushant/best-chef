<?php
/**
 * Plugin Name: Recent Posts Tab Widget
 * Description: A widget that displays Tab with recent/popular posts and recent comments.
 * Version: 1.0
 * Author: LeopardThemes
 */


add_action( 'widgets_init', 'creativa_recent_posts_tab' );


function creativa_recent_posts_tab() {
	register_widget( 'Creativa_Recent_Posts_Tab' );
}


class Creativa_Recent_Posts_Tab extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_posts_tab', 'description' => esc_html__('A widget that displays Tabs with recent/popular posts and recent comments. ', 'creativa') );
		parent::__construct('recent-posts-tab', esc_html__('Creativa - Recent Posts Tabs', 'creativa'), $widget_ops);
		$this->alt_option_name = 'recent_posts_tab';
	}

	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts_tab', 'widget' );
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

		// $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts Tab' );

		/** This filter is documented in wp-includes/default-widgets.php */
		// $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number_recent = ( ! empty( $instance['number_recent'] ) ) ? absint( $instance['number_recent'] ) : 3;
		if ( ! $number_recent )
			$number_recent = 3;

		$number_comments = ( ! empty( $instance['number_comments'] ) ) ? absint( $instance['number_comments'] ) : 3;
		if ( ! $number_comments )
			$number_comments = 3;

		$show_popular_posts = isset( $instance['show_popular_posts'] ) ? $instance['show_popular_posts'] : true;
		$show_recent_comments = isset( $instance['show_recent_comments'] ) ? $instance['show_recent_comments'] : true;

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
		<?php // if ( $title ) echo ''.$before_title . $title . $after_title; ?>

		<?php $random_tab_id = rand(1, 9999) ?>

		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
		  	<li class="recent-posts-tab active"><a href="#recent-posts-tab-<?php echo intval($random_tab_id) ?>" data-toggle="tab" class="ui-tabs-anchor"><?php esc_html_e('Recent', 'creativa') ?></a></li>
		  	<?php if ($show_popular_posts) { ?><li class="popular-posts-tab"><a href="#popular-posts-tab-<?php echo intval($random_tab_id) ?>" data-toggle="tab" class="ui-tabs-anchor"><?php esc_html_e('Popular', 'creativa') ?></a></li><?php } ?>
			<?php if ($show_recent_comments) { ?><li class="recent-comments-tab"><a href="#recent-comments-tab-<?php echo intval($random_tab_id) ?>" data-toggle="tab" class="ui-tabs-anchor"><i class="fa fa-comments"></i></a></li><?php } ?>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane fade in active" id="recent-posts-tab-<?php echo intval($random_tab_id) ?>">

			<ul class="recent_posts">
		  	<?php 
				$r = new WP_Query( apply_filters( 'widget_posts_args', array(
					'posts_per_page'      => intval($number_recent),
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true
				) ) );

				if ($r->have_posts()) :
			?>

				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
						<span class="post-date"><?php echo get_the_date(); ?></span>
					</li>
				<?php endwhile; wp_reset_postdata(); else : ?>

					<?php esc_html_e('No posts were found...', 'creativa'); ?>

         	<?php endif; ?>

			<?php wp_reset_postdata(); ?>
			</ul>

		  </div>

		  <?php if ($show_popular_posts) { ?>

		  <div class="tab-pane fade" id="popular-posts-tab-<?php echo intval($random_tab_id) ?>">

			<ul class="popular_posts">

		  	<?php 
				$r = new WP_Query( apply_filters( 'widget_posts_args', array(
					'posts_per_page'      => intval($number_recent),
					'no_found_rows'       => true,
					'meta_key'			  => 'post_views_count',
					'orderby'			  => 'meta_value_num',
					'order'				  => 'DESC',
					'post_status'         => 'publish',
					'date_query' => array(
						array(
							'column' => 'post_date_gmt',
							'after' => '6 months ago',
						),
					),
					'ignore_sticky_posts' => true
				) ) );

				if ($r->have_posts()) :
			?>

				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
						<span class="post-date"><?php echo get_the_date(); ?></span>
						<span class="post-views"><?php echo creativa_get_post_count(get_the_ID()); ?> <?php esc_html_e('Views', 'creativa') ?></span>
					</li>
				<?php endwhile; wp_reset_postdata(); else : ?>

            	<li class="no-posts-popular">
					<?php esc_html_e('No popular posts in last 6 months.', 'creativa'); ?>
            	</li>

         	<?php endif; ?>


			</ul>

			<?php // wp_reset_postdata(); ?>


		  </div>

		  <?php } ?>
		  <?php if ($show_recent_comments) { ?>

		  <div class="tab-pane fade" id="recent-comments-tab-<?php echo intval($random_tab_id) ?>">
		  	<?php 
		  		global $comment;

		  		$output = '';	

				$comments = get_comments( apply_filters( 'widget_comments_args', array(
					'number'      => intval($number_comments),
					'status'      => 'approve',
					'post_status' => 'publish'
				) ) );

				$output .= '<ul class="recent_comments">';
				if ( $comments ) {
					// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
					$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
					_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

					foreach ( (array) $comments as $comment) {
						$output .=  '<li><span class="comment-author-tab">' . /* translators: comments widget: 1: comment author, 2: post link */ sprintf(__('<span>%1$s</span> says %2$s', 'creativa'), get_comment_author_link(), '</span><a class="recent_comments_excerpt" href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . wp_html_excerpt( $comment->comment_content, 60, ' [...]' ) . '</a>') . '</li>';
					}
				} else {
					$output .= '<li class="no-posts-popular">'. esc_html__('No comments were found...', 'creativa') .'</li>';
				}
				$output .= '</ul>';

				echo ''.$output;
				?>

		  </div>

		  <?php } ?>

		</div>


		<?php echo ''.$after_widget; ?>
<?php


		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts_tab', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_recent'] = (int) $new_instance['number_recent'];
		$instance['number_comments'] = (int) $new_instance['number_comments'];
		$instance['show_popular_posts'] = isset( $new_instance['show_popular_posts'] ) ? (bool) $new_instance['show_popular_posts'] : false;
		$instance['show_recent_comments'] = isset( $new_instance['show_recent_comments'] ) ? (bool) $new_instance['show_recent_comments'] : false;

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_posts_tab']) )
			delete_option('widget_recent_posts_tab');

		return $instance;
	}

	function form( $instance ) {
		$number_recent    = isset( $instance['number_recent'] ) ? absint( $instance['number_recent'] ) : 3;
		$number_comments    = isset( $instance['number_comments'] ) ? absint( $instance['number_comments'] ) : 3;
		$show_popular_posts = isset( $instance['show_popular_posts'] ) ? (bool) $instance['show_popular_posts'] : true;
		$show_recent_comments = isset( $instance['show_recent_comments'] ) ? (bool) $instance['show_recent_comments'] : true;
?>
		<p><label for="<?php echo ''.$this->get_field_id( 'number_recent' ); ?>"><?php esc_html_e( 'Number of recent/popular posts to show:', 'creativa' ); ?></label>
		<input id="<?php echo ''.$this->get_field_id( 'number_recent' ); ?>" name="<?php echo ''.$this->get_field_name( 'number_recent' ); ?>" type="text" value="<?php echo ''.$number_recent; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_popular_posts ); ?> id="<?php echo ''.$this->get_field_id( 'show_popular_posts' ); ?>" name="<?php echo ''.$this->get_field_name( 'show_popular_posts' ); ?>" />
		<label for="<?php echo ''.$this->get_field_id( 'show_popular_posts' ); ?>"><?php esc_html_e( 'Display Popular Posts Tab', 'creativa' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_recent_comments ); ?> id="<?php echo ''.$this->get_field_id( 'show_recent_comments' ); ?>" name="<?php echo ''.$this->get_field_name( 'show_recent_comments' ); ?>" />
		<label for="<?php echo ''.$this->get_field_id( 'show_recent_comments' ); ?>"><?php esc_html_e( 'Display Recent Comments Tab', 'creativa' ); ?></label></p>
		
		<p><label for="<?php echo ''.$this->get_field_id( 'number_comments' ); ?>"><?php esc_html_e( 'Number of recent comments to show:', 'creativa' ); ?></label>
		<input id="<?php echo ''.$this->get_field_id( 'number_comments' ); ?>" name="<?php echo ''.$this->get_field_name( 'number_comments' ); ?>" type="text" value="<?php echo ''.$number_comments; ?>" size="3" /></p>

<?php
	}
}


?>