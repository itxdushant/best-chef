<form class="search" action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
	<div class="input-group">
		<input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="<?php esc_html_e('Search', 'creativa') ?>" />
		<span class="input-group-addon"><i class="icon_search"></i></span>
	</div>
</form>