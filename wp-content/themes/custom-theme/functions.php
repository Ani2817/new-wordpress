<?php

////////////////////
	
	function awesome_taxonomies(){

		$lables = array(
          'name'=>'price',
          'singular_name'=>'price',
          'all_items'=>'search price',
          'parent_items'=>'all price',
          'parent_item_colon'=>'parent price',
          'edit_item'=>'edit price',
          'update_item'=>'update price',
          'add_new_item'=>'add new price',
          'new_item_name'=> 'new price name',
          'menu_name'=>'price'

		);

		$args = array(
			'hierarchical'=> true,
			'labels'=>$lables,
			'show_ui'=>true,
			'show_admin_column'=>true,
			'query_var'=>true,
			'rewrite'=>array('slug'=> 'price')

		);

		register_taxonomy('price',array('post'.'page'),$args);
	}	

	add_action('init','awesome_taxonomies');


?>