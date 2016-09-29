<?php
$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
	<div>
		<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Zoeken naar...', 'woocommerce' ) . '" />
		<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
		<input type="hidden" name="post_type" value="product" />
		<button type="submit" form="searchform" value="Submit"><i class="fa fa-search" aria-hidden="true"></i></button>
	</div>
</form>

';

echo $form;
?>