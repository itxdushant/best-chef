<?php

/***********************************************************************************************/
/* Prevent the direct loading of comments.php */
/***********************************************************************************************/
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/***********************************************************************************************/
/* If the post is password protected then display text and return */
/***********************************************************************************************/
if (post_password_required()) : ?>
	<p>
		<?php 
			_e( 'This post is password protected. Enter the password to view the comments.', 'creativa');
			return;
		?>
	</p>

<?php endif;

/***********************************************************************************************/
/* If we have comments to display, we display them */
/***********************************************************************************************/
if (comments_open()) : ?>
		<a href="#respond" class="article-add-comment"></a>

		<?php if (is_single()) { ?>
			<h3><?php comments_number(esc_html__('No Comments - be the first.', 'creativa'), esc_html__('Comment: 1', 'creativa'), esc_html__('Comments: %', 'creativa')); ?></h3>
		<?php } ?>

		<?php if (is_page()) { ?>
			<h3><?php echo esc_html__('Comments:', 'creativa') ?></h3>
		<?php } ?>


		<ul class="commentslist">
			<?php wp_list_comments('callback=creativa_comments'); ?>
		</ul>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
		
			<div class="comment-nav-section clearfix">
			
				<?php $args = array(
                'before'           => '<ul class="wp_link_pages"><li><span>',
                'after'            => '</span></li></ul>',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'separator'        => '</span></li><li><span>',
                'nextpagelink'     => '',
                'previouspagelink' => '',
                'pagelink'         => '%',
                'echo'             => 1
                 );

                 paginate_comments_links( $args ); ?>
				
			</div> <!-- end comment-nav-section -->
		
		<?php endif; ?>

<?php
/***********************************************************************************************/
/* If we don't have comments and the comments are closed, display a text */
/***********************************************************************************************/

	elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
	
<?php endif; 

/***********************************************************************************************/
/* Display the comment form */
/***********************************************************************************************/
comment_form();

?>