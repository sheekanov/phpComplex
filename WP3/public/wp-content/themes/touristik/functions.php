<?php
add_theme_support('post-thumbnails');
add_theme_support('menus');
remove_filter( 'the_content', 'wpautop' );

// Register Custom Post Type
function stocks_post_type() {

    $labels = array(
        'name'                  => _x( 'Акции', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Акция', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Акции', 'text_domain' ),
        'name_admin_bar'        => __( 'Акции', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'attributes'            => __( 'Item Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Items', 'text_domain' ),
        'add_new_item'          => __( 'Добавить Акцию', 'text_domain' ),
        'add_new'               => __( 'Добавить', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'view_items'            => __( 'View Items', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Изображение акции', 'text_domain' ),
        'set_featured_image'    => __( 'Установить изображение акции', 'text_domain' ),
        'remove_featured_image' => __( 'Удалить изображение акции', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Акция', 'text_domain' ),
        'description'           => __( 'Post Type Description', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'stocks', $args );

}
add_action( 'init', 'stocks_post_type', 0 );

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<div id="%1$s" class="sidebar__sidebar-item %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar-item__title">',
        'after_title' => '</div>',
    ));
}