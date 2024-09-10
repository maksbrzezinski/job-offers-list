<article class="job-card flex flex-col md:flex-row gap-5 border border-gray-200 rounded-lg p-4 shadow-lg min-h-52 mb-2">
  <div class="flex-none w-full md:w-48 bg-gray-50 rounded-lg overflow-hidden">
      {{ the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']);}}
  </div>

  <div class="flex-1 flex flex-col justify-between">
      <div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $post->post_title }}</h3>

          @if (get_field('position', $post))
              <p class="text-gray-700 text-lg">{{ get_field('position', $post) }}</p>
          @endif

          @php
          $content = apply_filters('the_content', $post->post_content);

          preg_match('/<p>(.*?)<\/p>/', $content, $matches);

          if (isset($matches[1])) {
              $trimmed_paragraph = wp_trim_words($matches[1], 20);
              echo '<p class="mt-4 text-gray-600">' . $trimmed_paragraph . '</p>';
          }
          @endphp
      </div>

      <div class="flex justify-between items-center mt-4">
          <time class="text-sm text-gray-500">
              @php
                  $post_date = get_the_date('Y-m-d', $post);
                  $current_date = date('Y-m-d');
                  $date_diff = date_diff(date_create($post_date), date_create($current_date));
                  if ($date_diff->days < 1) {
                    echo __('Dodane dzisiaj', 'text-domain');
                  }
                  else if ($date_diff->days === 1) {
                    echo $date_diff->days . ' ' .__('dzień temu', 'text-domain');
                  }
                  else {
                    echo $date_diff->days . ' ' .__('dni temu', 'text-domain');
                  }
              @endphp
          </time>

          <a href="{{ get_permalink($post) }}" class="py-2 px-5 bg-violet-500 text-white font-semibold rounded-full shadow-md hover:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-400 focus:ring-opacity-75" title="{{ $post->post_title }}">@php echo __('Więcej', 'text-domain') @endphp</a>
      </div>
  </div>
</article>
