<?php /* Template Name: Front Page */?>
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rise_business
 */

get_header();
?>

<?php
/**
* page: section_templates/templtes.php
* Hooks: rise_business_homepage
	rise_business_add_slider- 15
	rise_business_add_about_us- 20
	rise_business_add_work- 25
	rise_business_add_service- 30
	rise_business_add_counter- 35
	rise_business_add_subscribe- 45
	rise_business_add_partner- 50
	rise_business_add_news- 55
*/
do_action ( 'rise_business_homepage' ); ?>

<?php get_footer(); ?>