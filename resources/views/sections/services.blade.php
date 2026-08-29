<section class="section" id="services">
  <div class="shell">
    <div class="section-head section-head-split">
      <div>
        <p class="eyebrow eyebrow-dark">What we do</p>
        <h2>Four services, one accountable partner</h2>
        <p class="section-lead">
          From certified workforce and procurement to construction and mechanical engineering delivery, we cover
          the full delivery chain so your operation keeps running.
        </p>
      </div>
      <a class="btn btn-outline" href="{{ route('services') }}">View all services</a>
    </div>

    @php
      $allServices = collect(config('company.services'));
      $featuredServices = $allServices->reject(fn (array $service) => ! empty($service['accent']))
        ->take(2)
        ->push($allServices->first(fn (array $service) => ! empty($service['accent'])));
    @endphp

    <div class="card-grid">
      @foreach ($featuredServices as $service)
        @include('partials.service-card', ['service' => $service])
      @endforeach
    </div>
  </div>
</section>
