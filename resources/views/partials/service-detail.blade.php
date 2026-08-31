<article class="service-detail" id="{{ $service['slug'] }}">
  @if (! empty($service['images']) && count($service['images']) > 1)
    <div class="service-figure-gallery">
      <figure class="service-figure">
        <img src="{{ asset('assets/images/services/' . $service['images'][0]['file']) }}" alt="{{ $service['images'][0]['alt'] }}" loading="lazy">
      </figure>
      <div class="service-figure-strip">
        @foreach (array_slice($service['images'], 1) as $image)
          <figure class="service-figure">
            <img src="{{ asset('assets/images/services/' . $image['file']) }}" alt="{{ $image['alt'] }}" loading="lazy">
          </figure>
        @endforeach
      </div>
    </div>
  @else
    <figure class="service-figure">
      <img src="{{ asset('assets/images/services/' . $service['image']) }}" alt="{{ $service['alt'] }}" loading="lazy">
    </figure>
  @endif

  <div class="service-body">
    <span class="icon-tile material-symbols-outlined" aria-hidden="true">{{ $service['icon'] }}</span>
    <h2>{{ $service['title'] }}</h2>
    <p class="service-lead">{{ $service['lead'] }}</p>

    @if (! empty($service['categories']))
      <div class="spec-grid">
        @foreach ($service['categories'] as $category)
          <div class="spec-card surface hover-lift">
            <h3>{{ $category['title'] }}</h3>
            <ul class="dot-list">
              @foreach ($category['items'] as $item)
                <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>
    @elseif (! empty($service['points']))
      <ul class="service-points dot-list dot-list-split">
        @foreach ($service['points'] as $point)
          <li>{{ $point }}</li>
        @endforeach
      </ul>
    @endif

    <a class="btn btn-primary" href="{{ route('contact', array_filter(['topic' => $service['topic'] ?? null, 'subject' => $service['title']])) }}#enquiry">Enquire about this service</a>
  </div>
</article>
