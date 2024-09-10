<?php

namespace App\Inc\Taxonomies;

class OfferCategory
{
    private string $taxonomy = 'offer_category';
    private array $postTypes = ['joboffer'];

    public function __construct()
    {
        add_action('init', [$this, 'register']);
    }

    public function register(): void
    {
        register_taxonomy(
            $this->taxonomy,
            $this->postTypes,
            [
                'labels' => [
                    'name' => __('Offer Categories', 'text-domain'),
                    'singular_name' => __('Offer Category', 'text-domain'),
                    'search_items' => __('Search Offer Categories', 'text-domain'),
                    'all_items' => __('All Offer Categories', 'text-domain'),
                    'parent_item' => __('Parent Offer Category', 'text-domain'),
                    'parent_item_colon' => __('Parent Offer Category:', 'text-domain'),
                    'edit_item' => __('Edit Offer Category', 'text-domain'),
                    'update_item' => __('Update Offer Category', 'text-domain'),
                    'add_new_item' => __('Add New Offer Category', 'text-domain'),
                    'new_item_name' => __('New Offer Category Name', 'text-domain'),
                    'menu_name' => __('Offer Categories', 'text-domain'),
                    'popular_items' => __('Popular Offer Categories', 'text-domain'),
                    'separate_items_with_commas' => __('Separate offer categories with commas', 'text-domain'),
                    'add_or_remove_items' => __('Add or remove offer categories', 'text-domain'),
                    'choose_from_most_used' => __('Choose from the most used offer categories', 'text-domain'),
                    'not_found' => __('No offer categories found', 'text-domain'),
                ],
                'hierarchical' => true,
                'query_var' => true,
                'public' => true,
                'show_in_rest' => true,
                'rest_base' => $this->taxonomy,
                'show_ui' => true,
                'show_in_quick_edit' => true,
                'publicly_queryable' => true,
                'rewrite' => [
                    'slug' => 'offer-category',
                    'with_front' => false,
                    'hierarchical' => true,
                ]
            ]
        );
    }
}
