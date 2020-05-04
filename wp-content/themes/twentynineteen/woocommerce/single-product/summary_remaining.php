<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = $post->post_excerpt;

if ( ! $short_description ) {
	return;
}

$dom= new DOMDocument(); 
$dom->preserveWhiteSpace = false;
$dom->formatOutput       = false;
$dom->loadHTML($short_description); 

$finder = new DomXPath($dom);

$classname="pdp-sizeFitDesc";
$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
$material = $dom->saveXML($nodes[0]);

$classname="index-sizeFitDesc";
$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
$spec = $dom->saveXML($nodes[0]);

?>
<div class="custom-product-details">
		<div class="columns">
			<div class="col-1">
				<?php echo $material; ?>
			</div>
			<div class="col-2">
			 	<?php echo $spec; ?>
		    </div>
		</div>
	</div>