<?php

namespace App\Helpers;

use WP_Query;

function get_offers_by_category($category_id) {
    $args = [
        'post_type'      => 'joboffer',
        'posts_per_page' => 5,
        'tax_query'      => [
            [
                'taxonomy' => 'offer_category',
                'field'    => 'term_id',
                'terms'    => $category_id,
            ],
        ],
    ];

    $query = new WP_Query($args);

    $offers = [];
    $total_pages = $query->max_num_pages;

    while ($query->have_posts()) {
        $query->the_post();
        $offers[] = view('components.job-single', [
            'post' => $query->post,
        ])->render();
    }

    wp_reset_postdata();

    return [
        'offers'     => $offers,
        'total_pages' => $total_pages,
    ];
}
