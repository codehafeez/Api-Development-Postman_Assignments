<?php
/**
 * Plugin Name: Custom API Endpoints
 */

// Get Books
function custom_get_books() {
    $args = array(
        // 'post_type' => 'book',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);
    $books = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $books[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'content' => get_the_content(),
            );
        }
    }

    return $books;
}

// Add Book
function custom_add_book($data) {
    $title = sanitize_text_field($data['title']);
    $content = sanitize_textarea_field($data['content']);

    $post_id = wp_insert_post(array(
        // 'post_type' => 'book',
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
    ));

    return $post_id;
}

// Update Book
function custom_update_book($data) {
    $post_id = absint($data['id']);
    $title = sanitize_text_field($data['title']);
    $content = sanitize_textarea_field($data['content']);

    $updated = wp_update_post(array(
        'ID' => $post_id,
        'post_title' => $title,
        'post_content' => $content,
    ));

    return $updated;
}

// Delete Book
function custom_delete_book($data) {
    $post_id = absint($data['id']);
    $deleted = wp_delete_post($post_id);

    return $deleted;
}

// Register API Endpoints
function custom_register_api_endpoints() {
    register_rest_route('custom/v1', '/books', array(
        'methods' => 'GET',
        'callback' => 'custom_get_books',
    ));

    register_rest_route('custom/v1', '/books/add', array(
        'methods' => 'POST',
        'callback' => 'custom_add_book',
    ));

    register_rest_route('custom/v1', '/books/update', array(
        'methods' => 'POST',
        'callback' => 'custom_update_book',
    ));

    register_rest_route('custom/v1', '/books/delete', array(
        'methods' => 'POST',
        'callback' => 'custom_delete_book',
    ));
}

add_action('rest_api_init', 'custom_register_api_endpoints');
