@php($activeNav = trim(Illuminate\Support\Facades\View::getSection('nav_active', '')))

<header class="site-header">
  <div class="shell nav-bar">
    <a class="brand" href="{{ route('home') }}">
      <img class="brand-logo" src="{{ asset('assets/mv-logo-full.svg') }}" alt="{{ config('company.name') }}" width="260" height="56">
      <img class="brand-logo brand-logo-light" src="{{ asset('assets/mv-logo-mark.svg') }}" alt="" aria-hidden="true" width="260" height="56">
    </a>

    <nav class="nav-links" id="primary-nav" aria-label="Primary">
      @foreach (config('company.navigation') as $item)
        <a class="nav-link @if ($item['key'] === $activeNav) is-active @endif"
           href="{{ isset($item['route']) ? route($item['route']) : $item['href'] }}">{{ $item['label'] }}</a>
      @endforeach
      <a class="btn btn-outline nav-cta-mobile" href="{{ route('contact') }}">Request a Quote</a>
    </nav>

    <div class="nav-actions">
      <a class="btn btn-primary nav-cta" href="{{ route('contact') }}">Request a Quote</a>
      <button class="nav-toggle" id="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Toggle navigation menu">
        <span class="material-symbols-outlined" id="nav-toggle-icon">menu</span>
      </button>
    </div>
  </div>
</header>
