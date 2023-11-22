<?php 
extract( $args );

$video = isset( $video ) && ! empty( $video ) ? $video : false;
$image = isset( $image ) && ! empty( $image ) ? $image : false;
$size  = isset( $size ) && ! empty( $size ) ? $size : false;
if ( $image ) {
    if( $size ) { 
        $img_url = $image['sizes'][$size]; 
    } else {
        $img_url = $image['url'];
    }
}
?>
<?php if ( $video ) : ?>
    <video loop autoplay playsinline muted preload="metadata" src="<?php echo esc_url( $video ); ?>"<?php echo $image ? ' poster="' . esc_url( $img_url ) . '"' : ''; ?>>
        <source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
    </video>
<?php elseif ( $image ) : ?>
    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
<?php endif; ?>
