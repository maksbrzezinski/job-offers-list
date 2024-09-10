<?php

function load_more_offers() {

    if ( ! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'load_more_offers_nonce') ) {
        wp_send_json_error(['message' => 'Nonce verification failed.']);
        return;
    }


    if (!isset($_POST['category_id']) || !isset($_POST['page'])) {
        wp_send_json_error(['message' => 'Invalid request.']);
        return;
    }

    $category_id = intval($_POST['category_id']);
    $page = intval($_POST['page']);

    $args = [
        'post_type'      => 'joboffer',
        'posts_per_page' => 5,
        'paged'          => $page,
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

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $offers[] = view('components.job-single', [
                'post' => $query->post,
            ])->render();
        }
    } else {
        wp_send_json_error(['message' => 'No more offers found.']);
        return;
    }

    wp_reset_postdata();

    wp_send_json_success([
        'offers'     => $offers,
        'total_pages' => $total_pages,
    ]);
}

add_action('wp_ajax_load_more_offers', 'load_more_offers');
add_action('wp_ajax_nopriv_load_more_offers', 'load_more_offers');
