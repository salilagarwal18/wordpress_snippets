<?php
function slug_save_post_callback( $post_ID, $post, $update ) {
    // allow 'publish', 'draft', 'future'
    if ($post->post_type != 'property' || $post->post_status == 'auto-draft')
        return;

    // only change slug when the post is created (both dates are equal)
    if ($post->post_date_gmt != $post->post_modified_gmt)
        return;

    // use title, since $post->post_name might have unique numbers added
    $new_slug = sanitize_title( $post->post_title, $post_ID );
    $unique_id = sanitize_title( get_field( 'unique_id', $post_ID ), '' );
    if (empty( $subtitle ) || strpos( $new_slug, $subtitle ) !== false)
		echo 'returned from here';
        return; // No subtitle or already in slug

    $new_slug .= '-' . $unique_id;
    if ($new_slug == $post->post_name)
		echo 'already set';
        return; // already set

    // unhook this function to prevent infinite looping
    remove_action( 'save_post', 'slug_save_post_callback', 10, 3 );
    // update the post slug (WP handles unique post slug)
    wp_update_post( array(
        'ID' => $post_ID,
        'post_name' => $new_slug
    ));
    // re-hook this function
    add_action( 'save_post', 'slug_save_post_callback', 10, 3 );
}
add_action( 'save_post', 'slug_save_post_callback', 10, 3 );
