<section class="section clients-section" aria-labelledby="clients-title">
  <div class="shell">
    <div class="section-head section-head-center">
      <p class="eyebrow eyebrow-dark">Our clients</p>
      <h2 id="clients-title">Trusted across mining, government and development</h2>
    </div>

    <div class="client-marquee">
      <div class="client-marquee-track">
        @for ($i = 0; $i < 2; $i++)
          <ul class="client-logos" @if ($i > 0) aria-hidden="true" @endif>
            @foreach (config('company.clients') as $client)
              <li>
                <img src="{{ asset('assets/clients/' . $client['logo']) }}" alt="{{ $i === 0 ? $client['name'] : '' }}" loading="lazy" @if ($i > 0) aria-hidden="true" @endif>
              </li>
            @endforeach
          </ul>
        @endfor
      </div>
    </div>

    <p class="client-more">{{ config('company.clients_note') }}</p>
  </div>
</section>
