@extends('layouts.app')

@section('title', 'Contact ' . config('company.short_name') . ' | Kitwe, Zambia')
@section('description', 'Contact MV Industrial & Mining Supplies Limited in Kitwe, Copperbelt. Request a quote for industrial and mining supplies, labour hire, procurement, construction and mechanical engineering.')
@section('nav_active', 'contact')

@php($contact = config('company.contact'))

@section('content')

  <section class="page-hero page-hero-low">
    <div class="page-hero-media" aria-hidden="true">
      <img src="{{ asset('assets/images/contact-handshake.jpg') }}" alt="">
      <span class="page-hero-veil"></span>
    </div>
    <div class="shell page-hero-inner">
      <div class="page-hero-copy">
        <p class="eyebrow">Contact us</p>
        <h1>Let's get your operation supplied</h1>
        <p class="page-hero-lead">
          Tell us what you need and our Kitwe team will come back with pricing, lead times and availability.
        </p>
      </div>
    </div>
  </section>

  <section class="section" id="enquiry">
    <div class="shell contact-page-grid">

      <div class="contact-form-panel">
        <h2>Send us an enquiry</h2>
        <p class="section-lead">
          Share your specification, quantities or crew requirements. Fields marked with an asterisk are required.
        </p>
        @include('partials.contact-form')
      </div>

      <aside class="contact-details">
        <div class="detail-card surface">
          <h3>Head office</h3>
          <ul class="contact-list contact-list-stacked">
            <li>
              <span class="icon-tile icon-tile-soft material-symbols-outlined" aria-hidden="true">location_on</span>
              <div>
                <h4>Visit us</h4>
                <p>{!! implode('<br>', array_map('e', $contact['address_lines'])) !!}</p>
              </div>
            </li>
            <li>
              <span class="icon-tile icon-tile-soft material-symbols-outlined" aria-hidden="true">call</span>
              <div>
                <h4>Call us</h4>
                <p>
                  @foreach ($contact['phones'] as $phone)
                    <a href="tel:{{ str_replace(' ', '', $phone) }}">{{ $phone }}</a>@if (! $loop->last)<br>@endif
                  @endforeach
                </p>
              </div>
            </li>
            <li>
              <span class="icon-tile icon-tile-soft material-symbols-outlined" aria-hidden="true">mail</span>
              <div>
                <h4>Email us</h4>
                <p><a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></p>
              </div>
            </li>
            <li>
              <span class="icon-tile icon-tile-soft material-symbols-outlined" aria-hidden="true">language</span>
              <div>
                <h4>Online</h4>
                <p><a href="{{ $contact['website'] }}" rel="noopener">{{ $contact['website_label'] }}</a></p>
              </div>
            </li>
          </ul>
        </div>

        <div class="detail-card surface">
          <h3>Office hours</h3>
          <ul class="hours-list">
            @foreach (config('company.office_hours') as $slot)
              <li>
                <span>{{ $slot['days'] }}</span>
                <span class="hours-value">{{ $slot['hours'] }}</span>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="detail-card detail-card-accent surface-accent">
          <h3>Registered and compliant</h3>
          <ul class="compliance-list dot-list">
            @foreach (config('company.compliance') as $item)
              <li>{{ $item }}</li>
            @endforeach
          </ul>
        </div>
      </aside>

    </div>
  </section>

@endsection
