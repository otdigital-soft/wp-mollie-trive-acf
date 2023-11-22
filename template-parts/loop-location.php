<?php
/**
 * loop location
 */
$lat     = get_field( 'latitude' );
$long    = get_field( 'longitude' );
$traffic = get_field( 'traffic' );
$cta     = get_field( 'cta' );
?>
<button class="nearby-location"
    id="nearby-location-<?php echo sanitize_title( get_the_title() ); ?>"
    data-longitude="<?php echo esc_attr( $long ); ?>" 
    data-latitude="<?php echo esc_attr( $lat ); ?>"
    data-directions>
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="nearby-location__img bg-cover">
        <?php the_post_thumbnail( 'loop-location' ); ?>
    </div>
    <?php endif; ?>
    <div class="nearby-location__content">
        <p class="text-lg nearby-location__title"><?php the_title(); ?></p>
        <?php if ( $traffic ) : ?>
            <p class="text-md nearby-location__traffic"><?php echo esc_html( $traffic ); ?></p>
        <?php endif; ?>
        <?php if ( has_excerpt( ) ) : ?>
            <div class="text-md nearby-location__excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>
        <?php
        get_template_part_args(
            'template-parts/content-modules-cta',
            array(
                'v'  => 'cta',
                'c'  => 'btn btn-primary',
                'w'  => 'div',
                'wc' => 'nearby-location__cta',
                'o'  => 'f',
            )
        );
        ?>
    </div>
</button>