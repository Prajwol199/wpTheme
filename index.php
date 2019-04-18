<?php
get_header();

?>
<section class="rt-news-section rt-bg-light py-7">
	<div class="container">
		<h2 class="rt-section-title position-relative mb-0 d-inline-block"><?php echo get_theme_mod('news_title') ?></h2>
			<div class="row">
				<?php 
				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					$args_pages = array(
						'post_type' => 'post',
						'orderby' => 'ID', 
						'order' => 'ASC',
						'posts_per_page' => 2,
						'paged' => $paged,
					);
					$query = new WP_Query( $args_pages );
					if ( $query->have_posts() ) :
						while (  $query->have_posts() ) :  $query->the_post(); ?>
							<?php get_template_part( 'template-parts/blog-template' );?>
						<?php endwhile; ?>		
					<?php endif; ?>
			</div><!-- row--><br>

			<?php if(get_theme_mod('blog_setting_selector') == 'pagination' ){?>
				<?php 
				$big = 999999999; // need an unlikely integer
				$args = array(
					'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'             => '?page=%#%',
					'total'              => $query->max_num_pages,
					'current'            => max( 1, get_query_var('paged') ),
					'show_all'           => false,
					'end_size'           => 1,
					'mid_size'           => 2,
					'prev_next'          => true,
					'prev_text'          => __('« Previous'),
					'next_text'          => __('Next »'),
					'type'               => 'array',		
			    );
				$pages = paginate_links( $args ); ?>
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<?php foreach ($pages as $key => $value) { ?>
							<li class="page-item page-link"><?php echo $value ?></a></li>
						<?php } ?>
					</ul>
				</nav>
				<!-- load more button -->
			<?php } ?>
			<?php if(get_theme_mod('blog_setting_selector') == 'ajax_loader' ){?>
				<?php
					global $wp_query; // you can remove this line if everything works for you
					 
					// don't display the button if there are not enough posts
					if (  $wp_query->max_num_pages > 1 )
						echo '<div class="post_loadmore">More posts</div>'; // you can use <a> as well
				?>
			<?php } ?>
				<?php wp_reset_query(); ?>
	</div><!-- container -->
</section><!-- blog section -->
<?php
get_footer();