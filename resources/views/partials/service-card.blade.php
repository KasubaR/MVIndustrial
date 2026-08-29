<article class="card @if (! empty($service['accent'])) card-accent @endif">
  <span class="card-icon material-symbols-outlined" aria-hidden="true">{{ $service['icon'] }}</span>
  <h3>{{ $service['title'] }}</h3>
  <p>{{ $service['summary'] }}</p>
  @if (! empty($service['points']))
    <ul class="card-list">
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
