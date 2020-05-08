<?php
/**
 * The template for displaying a single post
 *
 * @package Layers
 * @since Layers 1.0.0
 */

get_header(); ?>

<div <?php post_class( 'content-main clearfix' ); ?>>

<div id="feat-img">
<?php
/**
* Display the Featured Thumbnail
*/
echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'thumbnail push-bottom', 'size' => 'full' ) );
?>

<span style="display:none;"><?php the_breadcrumb(); ?></span>
</div>


	<?php do_action('layers_before_post_loop'); ?>
	<div class="grid">
		<?php get_sidebar( 'left' ); ?>

    <?php if ( have_rows( 'refferal_links' ) ) : ?>
    	<?php while ( have_rows( 'refferal_links' ) ) : the_row(); ?>
    		<?php the_sub_field( 'company_name' ); ?>
    		<?php the_sub_field( 'lien' ); ?>
    		<?php the_sub_field( 'provenance' ); ?>
    		<?php the_sub_field( 'intention' ); ?>
    		<?php the_sub_field( 'sujet_central' ); ?>
    	<?php endwhile; ?>
    <?php endif; ?>

		<?php if( have_posts() ) : ?>

			<?php while( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php layers_center_column_class(); ?>>
					<?php get_template_part( 'partials/content', 'single' ); ?>
				</article>
			<?php endwhile; // while has_post(); ?>

		<?php endif; // if has_post() ?>

		<?php get_sidebar( 'right' ); ?>
	</div>
	<?php do_action('layers_after_post_loop'); ?>
</div>

<?php get_footer();
