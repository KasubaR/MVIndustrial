<article @class(['card', 'hover-lift', 'surface' => empty($service['accent']), 'surface-accent card-accent' => ! empty($service['accent'])])>
  <span class="icon-tile material-symbols-outlined" aria-hidden="true">{{ $service['icon'] }}</span>
  <h3>{{ $service['title'] }}</h3>
  <p>{{ $service['summary'] }}</p>
  @if (! empty($service['points']))
    <ul class="card-list dot-list">
      @foreach ($service['points'] as $point)
        <li>{{ $point }}</li>
      @endforeach
    </ul>
  @endif
  @if (! empty($service['slug']))
    <a class="card-link" href="{{ route('services.show', $service['slug']) }}">
      View details
      <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
    </a>
  @endif
</article>
