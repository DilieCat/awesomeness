<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-footer-newsletter"><div class="col-full"><?php echo do_shortcode( '[mc4wp_form id="36"]' ); ?></div></div>
    <div class="site-footer-bg">
		<div class="col-full">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' ); ?>

		</div><!-- .col-full -->
        </div>
        <div class="site-info">
		&copy; <?php echo "2004 - " . date( 'Y' ). " " . get_bloginfo( 'name' ); ?>
	</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->
<?php wp_footer(); ?>

<?php $logo  = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );  ?>
<span itemscope itemtype="http://schema.org/LocalBusiness">
<meta itemprop="name" content="<?php echo get_bloginfo( 'name' ); ?>" />
<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
<meta itemprop="streetAddress" content="Westzeedijk 399" />
<meta itemprop="postalCode" content="3024 EK"/>
<meta itemprop="addressLocality" content="Rotterdam" />
</span>
<meta itemprop="url" content="https://canvasfoto.nl/" />
<meta itemprop="logo" content="<?php echo $logo[0]; ?>" />
<meta itemprop="paymentAccepted" content="cash" />
<meta itemprop="paymentAccepted" content="credit card" />
<meta itemprop="paymentAccepted" content="paypal" />
<meta itemprop="currenciesAccepted" content="EUR" />
<meta itemprop="openingHours" content="Mo-Fr 09:00-18:00" />
<meta itemprop="telephone" content="085-0110128" />
<meta itemprop="email" content="info@canvasfoto.nl" />

<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
<meta itemprop="ratingValue" content="5" />
<meta itemprop="reviewCount" content="1639" />
</span>
</span>

</body>
</html>
