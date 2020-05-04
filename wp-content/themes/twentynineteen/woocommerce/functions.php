<?php

function change_order()
{
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 500 );
}

add_action( 'woocommerce_single_product_summary', 'change_order' );