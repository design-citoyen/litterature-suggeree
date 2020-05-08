<?php

/**
* Refferal Block Template.
*
* @param array $block The block settings and attributes.
* @param string $content The block inner HTML (empty).
* @param bool $is_preview True during AJAX preview.
* @param (init|string) $post_id The post ID this block is saved to.
*
*/

// Create id attribute allowing for custom "anchor" value.

// Create id attribute allowing for custom "anchor" value.
$id = 'refferallist-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'refferal';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('testimonial') ?: 'Your testimonial here...';
$author = get_field('author') ?: 'Author name';
$role = get_field('role') ?: 'Author role';
$image = get_field('image') ?: 295;
$background_color = get_field('background_color');
$text_color = get_field('text_color');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <blockquote class="testimonial-blockquote">
        <span class="testimonial-text"><?php echo $text; ?></span>
        <span class="testimonial-author"><?php echo $author; ?></span>
        <span class="testimonial-role"><?php echo $role; ?></span>
    </blockquote>
    <div class="testimonial-image">
        <?php echo wp_get_attachment_image( $image, 'full' ); ?>
    </div>
    <style type="text/css">
        <?php echo $id; ?> {
            background: <?php echo $background_color; ?>;
            color: <?php echo $text_color; ?>;
        }
    </style>
</div>

<?php if ( have_rows( 'liste_de_livres' ) ) : ?>
	<?php while ( have_rows( 'liste_de_livres' ) ) : the_row(); ?>
		<?php $choix_du_livre = get_sub_field( 'choix_du_livre' ); ?>
		<?php if ( $choix_du_livre ) : ?>
			<?php foreach ( $choix_du_livre as $post_ids ) : ?>
				<div class="book_item">
          <a href="<?php echo get_permalink( $post_ids ); ?>">
            <ul>
              <li><img src="<?php get_the_post_thumbnail_url($post_ids,'full') ?>"></li>
              <li><?php echo get_the_title( $post_ids ); ?></li>
            </ul>
          </a>
       </div>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else : ?>
	<?php // no rows found ?>
<?php endif; ?>
