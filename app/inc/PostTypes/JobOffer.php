<?php

namespace App\Inc\PostTypes;

class JobOffer
{
    private string $postType = 'joboffer';

    public function __construct()
    {
        add_action('init', [$this, 'registerCPT']);
        add_filter('manage_' . $this->postType . '_posts_columns', [$this, 'addCustomColumns']);
        add_action('manage_' . $this->postType . '_posts_custom_column', [$this, 'renderCustomColumns'], 10, 2);
    }

    public function registerCPT()
    {
        register_post_type($this->postType, [
            'labels' => [
                'name' => __('Job Offers', 'text-domain'),
                'singular_name' => __('Job Offer', 'text-domain'),
                'add_new' => __('Add New Job Offer', 'text-domain'),
                'add_new_item' => __('Add New Job Offer', 'text-domain'),
                'edit_item' => __('Edit Job Offer', 'text-domain'),
                'new_item' => __('New Job Offer', 'text-domain'),
                'view_item' => __('View Job Offer', 'text-domain'),
                'search_items' => __('Search Job Offers', 'text-domain'),
                'not_found' => __('No Job Offers found', 'text-domain'),
                'not_found_in_trash' => __('No Job Offers found in Trash', 'text-domain'),
            ],
            'public' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'rewrite' => ['slug' => 'joboffer', 'with_front' => true],
            'has_archive' => true,
            'exclude_from_search' => false,
            'menu_icon' => 'dashicons-welcome-widgets-menus',
            'publicly_queryable' => true,
            'show_in_rest' => true,
            'hierarchical' => false,
        ]);
    }

    public function addCustomColumns($columns)
    {
        $columns['joboffer_taxonomies'] = __('Taxonomies', 'text-domain');
        return $columns;
    }

    public function renderCustomColumns($column, $postId)
    {
        if ($column === 'joboffer_taxonomies') {
            $taxonomies = get_object_taxonomies($this->postType, 'objects');
            foreach ($taxonomies as $taxonomy) {
                $terms = get_the_terms($postId, $taxonomy->name);
                if ($terms && !is_wp_error($terms)) {
                    $terms_list = array();
                    foreach ($terms as $term) {
                        $terms_list[] = $term->name;
                    }
                    echo '<strong>' . esc_html($taxonomy->label) . ':</strong> ' . implode(', ', $terms_list) . '<br>';
                }
            }
        }
    }
}
