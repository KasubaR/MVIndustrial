@extends('layouts.app')

@section('title', 'Services | ' . config('company.short_name'))
@section('description', 'Labour hire, procurement, construction and civil engineering, and mechanical engineering services delivered across Zambia from Kitwe.')
@section('nav_active', 'services')

@php($safety = config('company.safety'))

@section('content')

  <section class="page-header">
    <div class="page-header-media" aria-hidden="true">
      <img src="{{ asset('assets/images/services/services-header.jpg') }}" alt="">
      <span class="hero-veil"></span>
    </div>
    <div class="shell page-header-inner">
      <div class="page-header-copy">
        <p class="eyebrow">Our services</p>
        <h1>Four capabilities, one accountable partner</h1>
        <p class="page-header-lead">{{ config('company.services_intro') }}</p>
      </div>
    </div>
  </section>

  <section class="section" id="services">
    <div class="shell card-grid">
      @foreach (config('company.services') as $service)
        @include('partials.service-card', ['service' => $service])
      @endforeach
    </div>
  </section>

  <section class="safety-band" id="health-and-safety">
    <div class="shell safety-inner">
      <figure class="safety-figure">
        <img src="{{ asset('assets/images/services/' . $safety['image']) }}" alt="{{ $safety['alt'] }}" loading="lazy">
      </figure>
      <div class="safety-copy">
        <span class="card-icon material-symbols-outlined" aria-hidden="true">health_and_safety</span>
        <h2>{{ $safety['title'] }}</h2>
        <p>{{ $safety['lead'] }}</p>
        <ul class="safety-points">
          @foreach ($safety['points'] as $point)
            <li>{{ $point }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </section>

  @include('sections.quote-band')

@endsection
