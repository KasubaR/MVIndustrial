<section class="section section-muted" id="about">
  <div class="shell about-grid about-grid-stretch">
    <div class="about-copy">
      <p class="eyebrow eyebrow-dark about-eyebrow">About us</p>
      <h2>Wholly Zambian-owned, built on delivery</h2>
      <p>
        {{ config('company.name') }} was incorporated in the Republic of Zambia under the
        Companies Act (388) on {{ config('company.incorporated_on') }}, registration number
        {{ config('company.registration_number') }}. We source, supply and deliver
        high-quality products and services that support mining operations and other industries across the country.
      </p>
      <p>
        Our commitment to excellence drives us to provide premium products that comply with both local and
        international standards. We believe customer satisfaction is achieved through teamwork, integrity and
        continuous improvement.
      </p>

      <div class="value-grid">
        @foreach (config('company.values') as $value)
          <div class="value">
            <span class="material-symbols-outlined" aria-hidden="true">{{ $value['icon'] }}</span>
            <h3>{{ $value['title'] }}</h3>
            <p>{{ $value['description'] }}</p>
          </div>
        @endforeach
      </div>

      <a class="btn btn-outline about-more" href="{{ route('about') }}">
        Read our full story
        <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
      </a>
    </div>

    <aside class="about-side about-side-solo">
      <figure class="about-figure">
        <img src="{{ asset('assets/images/about/about-technician.jpg') }}" alt="An MV technician in personal protective equipment inside a workshop" loading="lazy">
      </figure>
    </aside>
  </div>
</section>
