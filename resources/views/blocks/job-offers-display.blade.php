@php
if (get_field('category_selection')) {
    $categories = get_field('category_selection');
} else {
    $categories = get_terms([
        'taxonomy'   => 'offer_category',
    ]);
}
@endphp

<div class="tabs job-categories px-6 max-w-3xl container">
    <h2 class="mb-12 h2">@php echo __('Oferty pracy:', 'text-domain') @endphp</h2>

    <div>
    @if ($categories)
        <ul class="nav-tabs flex flex-wrap gap-row gap-4 lg:gap-12 mb-4">
            @foreach ($categories as $category)
                <li class="">
                    <button class="tab-item p-4 md:px-6 md:py-3 transition-colors duration-300 ease-in-out rounded-lg text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none active:bg-gray-300 [&.active]:bg-blue-500 [&.active]:text-white" data-target="#{{$category->slug}}">
                        {{ $category->name }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach ($categories as $index => $category)
                @php
                    $offers = App\Helpers\get_offers_by_category($category->term_id);
                @endphp
                <div class="tab-pane mt-4 flex flex-col gap-2" id="{{ $category->slug }}" >
                    @if ($offers['offers'])
                        @foreach ($offers['offers'] as $offer)
                            {!! $offer !!}
                        @endforeach

                        @if ($offers['total_pages'] > 1)
                        <button
                        class="load-more-offers inline-block border border-blue-600 mt-12 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out disabled:opacity-50 disabled:pointer-events-none"
                        data-target="#{{$category->slug}}"
                        data-category="{{ $category->term_id }}"
                        data-page="2">
                        @php echo __('Więcej ofert', 'text-domain') @endphp
                        </button>
                        @endif
                    @else
                        <p>@lang('Nie znaleziono ofert.')</p>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p>@lang('Nie znaleziono ofert.')</p>
    @endif
</div>
