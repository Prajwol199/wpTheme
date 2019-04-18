<?php 

class Post_type{

	public function add_post_type( $post_name, $labels_parameters = false , $arguments_parameter = false , $taxonomies = false ){
		$labels = array(
					'name' => ucfirst($post_name)
			);
		if( $labels_parameters ) {
			$labels = array_merge( $labels, $labels_parameters ); 
		}

		if($arguments_parameter == true ){
			$args = array(
				'labels' => $labels,
			);

			$arguments = array_merge($args,$arguments_parameter);
		}else{
			$arguments = array(
				'labels' => $labels,
				'public' => true,
				'has_archive' => true,
				'publicly_queryable' => true,
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'supports' => array(
					'title',
					'editor',
					'excerpt',
					'thumbnail',
					'revisions',
				),
				'menu_position' => 5,
				'exclude_from_search' => false
			);
		}

		if( $taxonomies ) {
			$arguments['taxonomies'] = $taxonomies;
		}
		register_post_type($post_name,$arguments);
	}	
}

// $obj = new Post_type;

// $obj->add_post_type('test',										//slug of post type
// 	apply_filters(
// 		'rise_business_test_post_type_lable_parameters', 			//lables prameters
// 		array(
// 			'singular_name' => 'test',
// 			'add_new'		=> 'Add test'
// 		)
//  	),
//  	apply_filters(
//  		'rise_business_test_post_type_arguments_parameters',		//arguments
//  		array(
//  			'public' => true,
//  		)
//  	),
//  	apply_filters(
//  		'rise_business_test_post_type_taxonomies',					//add taxonomies
//  		array(
//  			'category',
//  			'post_tag',
//  		)
//  	)
// ) ;

// $obj->add_post_type('test');