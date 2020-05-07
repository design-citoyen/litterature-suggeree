<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

<div id="apercu">
	<ul>
	    <li><?php if ( get_field( 'pdf_preview' ) ) { ?>
	    <a href="<?php the_field( 'pdf_preview' ); ?>" class="preview-pdf" target="_blank" alt="Aperçu" rel="noopener"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/file.png"/></a>
	    <?php } ?></li>
	    <li><?php if ( get_field( 'video_url' ) ) { ?>
<script type="text/javascript">
jQuery(function ($) {
    $("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>
	    <a href="<?php the_field('video_url'); ?>" class="preview-video" rel="prettyPhoto" alt="Vidéo"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/video.png"/></a>
	    <?php } ?></li>
	</ul>
</div>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
