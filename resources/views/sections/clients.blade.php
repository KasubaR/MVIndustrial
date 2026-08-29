<section class="section clients-section" aria-labelledby="clients-title">
  <div class="shell">
    <div class="section-head section-head-center">
      <p class="eyebrow eyebrow-dark">Our clients</p>
      <h2 id="clients-title">Trusted across mining, government and development</h2>
    </div>
    <ul class="client-logos">
      @foreach (config('company.clients') as $client)
        <li>
          <img src="{{ asset('assets/clients/' . $client['logo']) }}" alt="{{ $client['name'] }}" loading="lazy">
        </li>
      @endforeach
    </ul>
    <p class="client-more">{{ config('company.clients_note') }}</p>
  </div>
</section>
