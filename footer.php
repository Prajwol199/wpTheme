<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rise_business
 */

?>
<footer class="rt-site-footer pt-5">
	<div class="container pb-5">
		<div class="row">

			<div class="col-12 col-md-6">
				<div class="rt-large-footer rt-logo">
					<?php get_sidebar();?>
				</div>
			</div>

			<div class="col-6 col-md-6">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="text">
							<?php dynamic_sidebar( 'footer_widget_2' ); ?>
							<!-- <div class="rt-social-group mt-4">
								<ul>
									<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								</ul>
							</div> -->
							<!-- social -->
						</div>
					</div>
					<div class="col-12 col-md-6">
						<ul class="footer-nav">
							<?php dynamic_sidebar( 'footer_widget_3' ); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copy-right py-3 text-center">
		<span> <span><span id="footer_description"><?php rise_business_footer_description(); ?></span><a href="<?php esc_html_e( get_theme_mod('footer_link') ) ?>">&nbsp;<span id="footer_theme_name"><?php rise_business_footer_theme_name(); ?></span></a></span></span>
	</div>
</footer><!-- site-footer -->
<?php wp_footer(); ?>

</body>
</html>
