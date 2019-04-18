<?php 
	function rise_business_add_slider() { ?>
		<section class="rt-banner-section">
			<div class="rt-banner-slider-init">
				<?php 
				$args = array( 
					'post_type' 		=> 'slider', 
					'posts_per_page' 	=> 2,
					'order_by'			=>'ID',
					'order'				=>'ASC'
				 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php
					$image = false;
					$attachment_id = get_post_thumbnail_id( get_the_ID() );
					if( $attachment_id ) {
						$image = wp_get_attachment_image_src( $attachment_id, 'full' );
					}
					?>
					<?php if ( count( $image ) > 0 ) { ?>
						<div class="rt-banner-has-bg position-relative" style="background-image: url(<?php echo $image[0];?>)">
							<div class="rt-banner-caption">
								<h2 class="rt-title-big"><?php the_title();  ?></h2>
								<p class="my-4"><?php the_content(); ?></p>
								<div class="rt-btn-group mt-4">
									<a href="<?php the_permalink(); ?>" class="btn rt-btn-primary rt-bg-primary text-white">know more </a>
								</div>
							</div>
						</div>
					<?php } ?>?
				<?php endwhile; ?>
				<?php 
					wp_reset_query();
					wp_reset_postdata();
				?>
			</div><!-- slider init -->
		</section><!-- banner section -->
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_slider', 15 );
remove_action('rise_business_homepage','rise_business_add_slider',15);

function all_in_one_slider(){
	do_shortcode('[all-in-one-slider]');
	do_shortcode('[all-in-one-gallery]');
	do_shortcode('[all-in-one-embed-post]');
	// echo do_shortcode('[instagram url="https://www.instagram.com/p/bNd86MSFv6"]');
	// do_shortcode('[embed]https://www.instagram.com/p/BwKFCfzgTJz/[/embed]');
	// echo $GLOBALS['wp_embed']->run_shortcode( '[embed]https://www.instagram.com/p/BwKFCfzgTJz/[/embed]' );
}
add_action( 'rise_business_homepage' , 'all_in_one_slider', 15 );

function rise_business_add_about_us() { ?>
	<?php if(get_theme_mod('radio_about_us') == 'show' ){?>
		<section class="rt-intro-sect bg-white py-7">
			<div class="container">
				<div class="row">
					<?php 
						$mod[] = get_theme_mod( 'page_info' );
						$args_pages = array(
							'posts_per_page' => 5,
							'post_type' => 'page',
							'post__in' => $mod,
							'orderby' => 'post__in'
						);				
						$query = new WP_Query( $args_pages );

						if ( $query->have_posts() ) :
						$count = 1;
						while ( $query->have_posts() ) : $query->the_post();
					?>
					<div class="col-md-6 col-12 rt-intro-wrapper">
						<div class="intro-text pr-5">
							<h2 class="rt-section-title position-relative mb-4"><?php the_title(); ?></h2>
							<p><?php the_content(); ?></p>
							<div class="rt-btn-group mt-4 pt-3">
								<a href="<?php esc_html_e( get_theme_mod('about_button_link')) ?>" class="btn rt-btn-primary rt-bg-primary text-white">know more </a>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<?php wp_reset_postdata(); ?>
					<div class="col-md-6 col-12">
						<div class="row">
							<?php for($i=1;$i<=4;$i++) {?>
								<figure class="rt-abt-img col-6">
									<img src="<?php echo esc_url( get_theme_mod( 'about_us_image-'.$i ) ); ?>" class="img-fluid" alt="abt-img">
								</figure>
							<?php } ?>
						</div>					
					</div>
				</div>
			</div>
		</section>
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_about_us', 20 );

function rise_business_add_work() { ?>
	<?php if(get_theme_mod('radio_work') == 'show'){ ?>
		<section class="rt-abt-section rt-bg-light py-7">
			<div class="container">
				<?php 
					$title = get_theme_mod('title');
					$description = get_theme_mod('description');						
					$founder = get_theme_mod('founder');						
				?>
				<h2 class="rt-section-title position-relative mb-5"><span id="title_work"><?php rise_business_title_work(); ?></span></h2>
				<div class="row">
					<?php 
						$args = array( 
							'post_type' 		=> 'work', 
							'posts_per_page' 	=> 6
						 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="col-6 col-md-4 mb-5">
							<div class="rt-service-box bg-white border position-relative mt-5 pt-5 pb-4 rt-shadow-hover">
								<div class="rounded-icon-wrapper border rounded-circle position-absolute">
									<i class="<?php  echo get_post_meta(get_the_ID(),'my_meta_box_text',true) ?>"></i>
								</div>
								<div class="service-content text-center pt-4 px-3">
									<h3 class="rt-inner-title mb-2"><?php the_title(); ?></h3>
									<p><?php the_content();?></p>
								</div>
							</div>
						</div><!-- col -->
					<?php endwhile;?>
					<?php wp_reset_query(); ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<div class="quote-owner">
					<p class="quote">
						<i class="fas fa-quote-left"></i>
						<span id="description_work"><?php rise_business_description_work(); ?></span>
					</p>
					<p><span class="name"><span id="founder"><?php rise_business_founder(); ?></span></span> <span class="position"> - <span id="position"><?php rise_business_position(); ?></span></span></p>
				</div>
			</div> <!-- container -->
		</section><!-- service section -->
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_work', 25 );

function rise_business_add_service() { ?>
	<?php if(get_theme_mod('radio_service') == 'show' ){?>
		<section class="rt-work-process py-7">
			<div class="container">
				<h2 class="rt-section-title position-relative mb-5"><span id="service_title"><?php rise_business_service_title(); ?></span></h2>
				<div class="row">
					<div class="col-12 col-md-6">
						<figure class="m-0">
							<img src="<?php echo esc_url( get_theme_mod( 'service_image' ) ); ?>" class="img-fluid" align="work-img" />
						</figure>
					</div><!-- left col -->
					<div class="col-12 col-md-6 pl-5">
						<div class="rt-accordian-wrapper">
						<?php 
						$args_service = array( 
							'post_type' 		=> 'service',
							'posts_per_page'	=> '10'
						 );
						$loop_services = new WP_Query( $args_service );
						while ( $loop_services->have_posts() ) : $loop_services->the_post(); ?>
							<div class="accordion" id="processAccordion-<?php the_ID() ?>">
							   <div class="card border-0 bg-white pt-0 position-relative">
								    <div class="card-header bg-white px-0 position-relative" id="heading-<?php the_ID() ?>">
								      	<h5 class="mb-0">
									        <button class="btn btn-link p-0" type="button" data-toggle="collapse" data-target="#collapse-<?php the_ID() ?>" aria-expanded="true" aria-controls="collapse-<?php the_ID() ?>">
									          <?php the_title(); ?>
									        </button>
								      </h5>
								    </div>
								    <div id="collapse-<?php the_ID() ?>" class="collapse" aria-labelledby="heading-<?php the_ID() ?>" data-parent="#processAccordion-<?php the_ID() ?>">
								       <div class="card-body px-0">
									        <?php the_content() ?>
								      	</div>
								    </div>
							    </div>					  
							</div><!-- accordion -->
						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
						<?php wp_reset_postdata(); ?>
						</div><!-- wrapper -->
					</div><!-- right col -->
				</div><!-- row -->
			</div><!-- container -->
		</section><!-- work process accordion -->
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_service', 30 );

function rise_business_add_counter() { ?>
	<?php if(get_theme_mod('radio_counter') == 'show' ){?>
		<section class="rt-counter-section py-7">
			<div class="container">
				<div class="row">
					<?php 
						$args = array( 
							'post_type' 		=> 'counter', 
							'posts_per_page' 	=> 4,
							'order_by'			=>'ID',
							'order'				=>'ASC'
						 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="col-6 col-md-3 counter-right-border">
								<div class="counter-content">
									<i class="<?php  echo get_post_meta(get_the_ID(),'my_meta_box_text',true) ?>"></i>
									<h4 class="rt-inner-title mb-0 rt-color-primary"><?php the_content();?></h4>
									<p class="mb-0"><?php the_title();?></p>
								</div>
							</div><!-- col -->
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div><!-- container -->
		</section><!-- counter section -->
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_counter', 35 );

function rise_business_add_expert() { ?>
	<?php if(get_theme_mod('radio_expert') == 'show' ){?>
		<section class="rt-team-section rt-bg-light py-7">
			<div class="container">
				<h2 class="rt-section-title position-relative mb-5"><span id="title_expert"><?php rise_business_title_expert(); ?></span></h2>
				<div class="row">
					<?php 
						$args = array( 
							'post_type' 		=> 'experts', 
							'posts_per_page' 	=> 3
						 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php
							$image = false;
							$attachment_id = get_post_thumbnail_id( get_the_ID() );
							if( $attachment_id ) {
								$image = wp_get_attachment_image_src( $attachment_id, 'full' );
							}
							?>
							<?php if ( count( $image ) > 0 ) { ?>
							<div class="col-12 col-md-4">
								<div class="rt-team-wrapper bg-white p-4 position-relative">
									<figure class="m-0 team-image">
										<img src="<?php echo $image[0];?>" class="img-fluid" alt="team-image" />
									</figure>
									<div class="team-content">
										<h3 class="rt-inner-title mb-2"><?php the_title() ?></h3>
										<p><?php the_excerpt() ?></p>
										<div class="rt-social-group">
											<ul>
												<li><a href="<?php  echo get_post_meta(get_the_ID(),'my_meta_box_facebook_link',true) ?>"><i class="fab fa-facebook-f"></i></a></li>
												<li><a href="<?php  echo get_post_meta(get_the_ID(),'my_meta_box_twitter_link',true) ?>"><i class="fab fa-twitter"></i></a></li>
												<li><a href="<?php  echo get_post_meta(get_the_ID(),'my_meta_box_linkedin_link',true) ?>"><i class="fab fa-linkedin-in"></i></a></li>
											</ul>
										</div><!-- social -->
									</div><!-- content -->
								</div> <!-- wrapper -->
							</div><!-- col -->
						<?php } ?>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</section><!-- team-section -->
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_expert', 40 );

function rise_business_add_subscribe() { ?>
	<?php $shortcode = get_theme_mod('shortcode'); ?>
	<?php if(get_theme_mod('radio_subscribe') == 'show' && !empty($shortcode) ){?>
		<section class="rt-news-letter-section text-center py-7 bg-white">
			<div class="container">
				<h2 class="rt-section-title position-relative mb-0 d-inline-block"><span id="subscribe_title"><?php rise_business_subscribe_title(); ?></span></h2>
				<p class="pt-3 pb-4 m-0"><span id="subscribe_description"><?php rise_business_subscribe_description(); ?></span></p>
				<div class="w-form">
					<?php echo do_shortcode($shortcode); ?>
			</div>
		</section><!-- news-letter section end -->
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_subscribe', 45 );

function rise_business_add_partner() { ?>
	<?php if(get_theme_mod('radio_partner') == 'show' ){?>
		<section class="rt-partner-section bg-white py-7">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-6">
						<h2 class="rt-section-title position-relative mb-0 d-inline-block"><span id="title_partner"><?php rise_business_title_partner(); ?></span></h2>
						<p class="pt-3 pb-4 m-0"><span id="description_partner"><?php rise_business_description_partner(); ?></span>.</p>
					</div>
					<div class="col-12 col-md-6">
						<div class="partner-slider-init">
							<?php  for($i=1;$i<=4;$i++){ ?>
								<figure>
									<a href="<?php esc_html_e( get_theme_mod('partner_visiting_link-'.$i) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'partner_image-'.$i ) ); ?>" class="img-fluid" alt="partner"></a>
								</figure>
							<?php } ?>
						</div>
					</div>
				</div>
			</div><!-- container -->
		</section><!-- partner section -->
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_partner', 50 );

function rise_business_add_news() { ?>
	<?php if(get_theme_mod('radio_news') == 'show' ){?>
	<section class="rt-news-section rt-bg-light py-7">
		<div class="container">
			<h2 class="rt-section-title position-relative mb-0 d-inline-block"><span id="news_title"><?php rise_business_news_title(); ?></span></h2>
				<div class="row">
					<?php 
						$args_pages = array(
							'posts_per_page' => 2,
							'post_type' => 'post',
							'orderby' => 'the_ID()', 
							'order' => 'ASC'
						);
						$query = new WP_Query( $args_pages );
						if ( $query->have_posts() ) :
							while (  $query->have_posts() ) :  $query->the_post(); ?>
								<?php get_template_part( 'template-parts/blog-template' );?>
							<?php endwhile; ?>		
						<?php endif; ?>
						<?php wp_reset_query(); ?>
						<?php wp_reset_postdata(); ?>
				</div><!-- row-->		
			<div class="rt-btn-group mt-5 text-center">
				<a href="<?php esc_html_e(get_theme_mod('news_button_link')); ?>" class="btn rt-btn-primary rt-bg-primary text-white"><?php esc_html_e( 'See All Post', 'rise-business' ); ?> </a>
			</div>
		</div><!-- container -->
	</section><!-- blog section -->
	<?php } ?>
<?php }
add_action( 'rise_business_homepage' , 'rise_business_add_news', 55 );