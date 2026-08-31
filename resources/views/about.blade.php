@extends('layouts.app')

@section('title', 'About ' . config('company.short_name') . ' | Wholly Zambian-owned since 2012')
@section('description', 'MV Industrial & Mining Supplies Limited is a wholly Zambian-owned company based in Kitwe, supplying and servicing the mining and industrial sectors since 2012.')
@section('nav_active', 'about')

@section('content')

  <section class="page-hero page-hero-low">
    <div class="page-hero-media" aria-hidden="true">
      <img src="{{ asset('assets/images/about/about-header.png') }}" alt="">
      <span class="page-hero-veil"></span>
    </div>
    <div class="shell page-hero-inner">
      <div class="page-hero-copy">
        <p class="eyebrow">About us</p>
        <h1>Wholly Zambian-owned, built on delivery</h1>
        <p class="page-hero-lead">
          Supplying and servicing the mining and industrial sectors from Kitwe since 2012, with the people,
          certifications and supplier network to back it up.
        </p>
      </div>
    </div>
  </section>

  <section class="stats" aria-label="Company highlights">
    <div class="shell stats-grid">
      @foreach (config('company.stats') as $stat)
        <div class="stat-card surface">
          <span class="stat-value">{{ $stat['value'] }}</span>
          <span class="stat-label">{{ $stat['label'] }}</span>
        </div>
      @endforeach
    </div>
  </section>

  <section class="section" id="story">
    <div class="shell about-grid about-grid-stretch">
      <div class="about-copy">
        <p class="eyebrow eyebrow-dark">Our story</p>
        <h2>From industrial supplies to a full-service partner</h2>
        @foreach (config('company.about_story') as $paragraph)
          <p>{{ $paragraph }}</p>
        @endforeach
      </div>

      <aside class="about-side about-side-solo">
        <figure class="about-figure">
          <img src="{{ asset('assets/images/about/about-technician.jpg') }}" alt="An MV technician in personal protective equipment inside a workshop" loading="lazy">
        </figure>
      </aside>
    </div>

    <div class="shell about-highlights">
      <div class="panel panel-vision hover-lift">
        <span class="icon-tile icon-tile-translucent material-symbols-outlined" aria-hidden="true">visibility</span>
        <h3>Our Vision</h3>
        <p>{{ config('company.vision') }}</p>
      </div>
      <div class="panel panel-mission hover-lift">
        <span class="icon-tile icon-tile-translucent material-symbols-outlined" aria-hidden="true">flag</span>
        <h3>Our Mission</h3>
        <p>{{ config('company.mission') }}</p>
      </div>
      <div class="panel panel-compliance hover-lift">
        <span class="icon-tile material-symbols-outlined" aria-hidden="true">policy</span>
        <h3>Registered and compliant</h3>
        <ul class="compliance-list dot-list">
          @foreach (config('company.compliance') as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </section>

  <section class="section section-muted" id="values">
    <div class="shell values-band">
      <figure class="values-figure">
        <img src="{{ asset('assets/images/about/about-portrait.jpg') }}" alt="An MV team member wearing a safety helmet" loading="lazy">
      </figure>
      <div class="values-copy">
        <p class="eyebrow eyebrow-dark">Our values</p>
        <h2>What we hold ourselves to</h2>
        <p class="section-lead">
          Three principles guide how we quote, hire and deliver, and they are the standard our clients hold us to.
        </p>
        <div class="value-grid value-grid-stacked">
          @foreach (config('company.values') as $value)
            <div class="value">
              <span class="material-symbols-outlined" aria-hidden="true">{{ $value['icon'] }}</span>
              <h3>{{ $value['title'] }}</h3>
              <p>{{ $value['description'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="why-us">
    <div class="shell">
      <div class="section-head">
        <p class="eyebrow eyebrow-dark">Why work with us</p>
        <h2>Six reasons operations keep coming back</h2>
        <p class="section-lead">
          We are measured on uptime, safety and delivery, so that is what we build the business around.
        </p>
        <a class="btn btn-outline" href="{{ route('services') }}">
          See what we deliver
          <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
        </a>
      </div>

      <div class="card-grid">
        @foreach (config('company.differentiators') as $item)
          <article class="card surface hover-lift">
            <span class="icon-tile material-symbols-outlined" aria-hidden="true">{{ $item['icon'] }}</span>
            <h3>{{ $item['title'] }}</h3>
            <p>{{ $item['description'] }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  @include('sections.clients')

  @include('sections.quote-band')

@endsection
