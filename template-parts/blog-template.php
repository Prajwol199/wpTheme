<?php
	$image = false;
	$attachment_id = get_post_thumbnail_id( get_the_ID() );
	if( $attachment_id ) {
		$image = wp_get_attachment_image_src( $attachment_id, 'full' );
	}
	?>
	<?php if ( count( $image ) > 0 ) { ?>
	<div class="col-12 col-md-6">
		<div class="blog-content-wrapper row mx-0 mt-4">
			<div class="pl-0 col-6">
				<figure class="m-0">
					<a href="#"><img src="<?php echo $image[0];?>" alt="blog" /></a>
				</figure>
			</div>
			<div class="col-6 pl-0">
				<div class="news-content">
					<h3 class="rt-inner-title mb-2"><a href="#"><?php the_title() ?></a></h3>
					<div class="post-meta mb-2">
						<span class="post-date text-muted fs-12"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></span>
					</div>
					<div class="news-text">
						<?php the_excerpt() ?>
					</div>
				</div><!-- content -->
			</div><!-- col -->
		</div>
	</div><!-- col -->
<?php } ?>



		
				
