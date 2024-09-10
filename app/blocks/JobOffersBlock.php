<?php

namespace app\Blocks;

class JobOffersBlock
{

  function addCustomBlock()
  {
    acf_register_block([
        'name'              => 'job-list-block',
        'title'             => __('Job offers block'),
        'description'       => __('Shows a list of job offers categorized'),
        'render_callback'   => function($block) {

          $view = view('blocks.job-offers-display');
          echo $view->render();

      },
    ]);

    return $this;
  }
}
