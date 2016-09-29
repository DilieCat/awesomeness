<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'normal' ); 
$logo  = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
?>

<span itemprop="author" itemscope itemtype="http://schema.org/Person">
	<meta itemprop="name" content="<?php echo get_the_author(); ?>" />
</span>

<meta itemprop="datePublished" content="<?php echo get_post_time( 'c' ); ?>" />
<meta itemprop="headline" content="<?php echo get_the_title(); ?>" />
<meta itemprop="dateModified" content="<?php echo get_the_modified_date( 'c' ); ?>" />

<span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
    <meta itemprop="url" content="<?php echo $image[0]; ?>" />
    <meta itemprop="width" content="<?php echo $image[1]; ?>" />
    <meta itemprop="height" content="<?php echo $image[2]; ?>" />
</span>

<meta itemprop="mainEntityOfPage" itemscope itemtype="http://schema.org/webpage" itemid="<?php echo get_the_permalink(); ?>"/>

<?php

?>


	<?php
	/**
	 * Functions hooked into storefront_single_post add_action
	 *
	 * @hooked storefront_post_header          - 10
	 * @hooked storefront_post_meta            - 20
	 * @hooked storefront_post_content         - 30
	 * @hooked storefront_init_structured_data - 40
	 */
	do_action( 'storefront_single_post' );
	?>

</article><!-- #post-## -->
