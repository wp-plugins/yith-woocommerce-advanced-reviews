<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

extract( $args );
$array_id = array();
if ( !empty( $value ) ) {
    $array_id = array_filter( explode( ',', $value ) );
}

?>
<div id="<?php echo $id ?>-container" class="image-gallery" <?php if (isset( $deps )): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>>
    <label for="<?php echo $id ?>"><?php echo $label ?></label>

    <p>
        <span class="desc inline"><?php echo $desc ?></span>
        <ul id="<?php echo $id ?>-extra-images" class="slides-wrapper extra-images ui-sortable clearfix">
            <?php if ( !empty( $array_id ) ) : ?>
                <?php foreach ( $array_id as $image_id ) : ?>
                    <li class="image" data-attachment_id = <?php echo esc_attr($image_id) ?>>
                        <a href="#">
                            <?php yit_image( "id=$image_id&size=admin-post-type-thumbnails" ); ?>
                        </a>
                        <ul class="actions">
                            <li><a href="#" class="delete" title="<?php _e( 'Delete image', 'yit' ); ?>">x</a></li>
                        </ul>
                    </li>
                <?php endforeach; endif; ?>
        </ul>
        <input type="button" data-choose="<?php _e( 'Add Images to Gallery', 'yit' ); ?>" data-update="<?php _e( 'Add to gallery', 'yit' ); ?>" value="<?php _e( 'Add images', 'yit' ) ?>" data-delete="<?php _e( 'Delete image', 'yit' ); ?>" data-text="<?php _e( 'Delete', 'yit' ); ?>" id="<?php echo $id ?>-button" class="image-gallery-button button" />
        <input type="hidden" class="image_gallery_ids" id="image_gallery_ids" name="<?php echo $name ?>" value="<?php echo esc_attr( $value ); ?>" />
    </p>
</div>