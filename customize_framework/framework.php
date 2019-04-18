<?php 
function rise_business_add_panel( $id , $priority , $title , $description ) {
	echo $id ; die;
	$wp_customize->add_panel( $id, array(
		'priority'       => $priority,
		'theme_supports' => '',
		'title'          => __( $title , 'rise_business' ),
		'description'    => __( $description , 'rise_business' ),
	) );
}
add_filter( 'add_pannel', 'rise_business_add_panel');