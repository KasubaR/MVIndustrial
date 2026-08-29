<article class="service-detail" id="{{ $service['slug'] }}">
  <figure class="service-figure">
    <img src="{{ asset('assets/images/services/' . $service['image']) }}" alt="{{ $service['alt'] }}" loading="lazy">
  </figure>

  <div class="service-body">
    <span class="card-icon material-symbols-outlined" aria-hidden="true">{{ $service['icon'] }}</span>
    <h2>{{ $service['title'] }}</h2>
    <p class="service-lead">{{ $service['lead'] }}</p>

    @if (! empty($service['categories']))
      <div class="spec-grid">
        @foreach ($service['categories'] as $category)
          <div class="spec-card">
            <h3>{{ $category['title'] }}</h3>
            <ul>
              @foreach ($category['items'] as $item)
                <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>
    @elseif (! empty($service['points']))
      <ul class="service-points">
        @foreach ($service['points'] as $point)
          <li>{{ $point }}</li>
        @endforeach
      </ul>
    @endif

    <a class="btn btn-primary" href="{{ route('contact') }}">Enquire about this service</a>
  </div>
</article>
