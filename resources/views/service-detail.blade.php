@extends('layouts.app')

@section('title', $service['title'] . ' | ' . config('company.short_name'))
@section('description', \Illuminate\Support\Str::limit($service['lead'], 155))
@section('nav_active', 'services')

@section('content')

  <section class="page-hero page-hero-low">
    <div class="page-hero-media" aria-hidden="true">
      <img src="{{ asset('assets/images/services/' . $service['image']) }}" alt="">
      <span class="page-hero-veil"></span>
    </div>
    <div class="shell page-hero-inner">
      <div class="page-hero-copy">
        <p class="eyebrow"><a class="breadcrumb-link" href="{{ route('services') }}">Services</a> / {{ $service['title'] }}</p>
        <h1>{{ $service['title'] }}</h1>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="shell service-list">
      @include('partials.service-detail', ['service' => $service])
    </div>
  </section>

  @if ($related->isNotEmpty())
    <section class="section section-muted">
      <div class="shell">
        <div class="section-head section-head-center">
          <p class="eyebrow eyebrow-dark">Explore more</p>
          <h2>Other services</h2>
        </div>
        <div class="card-grid">
          @foreach ($related as $relatedService)
            @include('partials.service-card', ['service' => $relatedService])
          @endforeach
        </div>
      </div>
    </section>
  @endif

  @include('sections.quote-band')

@endsection
