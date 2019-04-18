<?php get_header(); ?>
<?php
if (have_posts()):
  while (have_posts()) : the_post(); ?>
  	<h1><?php the_title(); ?></h1>
    <p><?php the_content() ; ?></p>
<?php
endwhile;
else:
  ecc_html_e( '<p>Sorry, no posts matched your criteria.</p>' );
endif;
?>
<?php get_footer(); ?>