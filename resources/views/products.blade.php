@extends('layouts.app')

@section('title', 'Products | ' . config('company.short_name'))
@section('description', 'Industrial and mining supplies stocked and sourced by MV Industrial & Mining Supplies Limited: electrical items, bearings, drilling tools, welding equipment, fluid and valve systems, mechanical spares, safety equipment and hardware.')
@section('nav_active', 'products')

@section('content')

  <section class="page-hero page-hero-low">
    <div class="page-hero-media" aria-hidden="true">
      <img src="{{ asset('assets/images/services/supplies.jpg') }}" alt="">
      <span class="page-hero-veil"></span>
    </div>
    <div class="shell page-hero-inner">
      <div class="page-hero-copy">
        <p class="eyebrow">Our products</p>
        <h1>Industrial &amp; mining supplies, stocked and ready</h1>
        <p class="page-hero-lead">{{ config('company.products_intro') }}</p>
      </div>
    </div>
  </section>

  <section class="section" id="products">
    <div class="shell">
      <div class="product-controls">
        <div class="product-search">
          <span class="material-symbols-outlined" aria-hidden="true">search</span>
          <input type="search" id="product-search" placeholder="Search products&hellip;" aria-label="Search products">
        </div>

        {{-- Upgraded into the custom dropdown by resources/js/listbox.js. --}}
        <div class="product-filter">
          <select id="product-category" aria-label="Filter by category" data-listbox="pill" data-listbox-icon="filter_list">
            <option value="all">All categories</option>
            @foreach (config('company.products') as $category)
              <option value="{{ $category['slug'] }}">{{ $category['title'] }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <p class="product-empty" id="product-empty" hidden>No products match your search.</p>

      <div class="product-grid" id="product-grid">
        @foreach (config('company.products') as $category)
          @foreach ($category['items'] as $item)
            <div
              class="product-tile-cell"
              data-category="{{ $category['slug'] }}"
              data-name="{{ strtolower($item) }}"
              data-title="{{ $item }}"
              data-icon="{{ $category['icon'] }}"
              data-category-title="{{ $category['title'] }}"
              data-category-summary="{{ $category['summary'] }}"
            >
              <label class="product-tile-checkbox icon-tile">
                <input type="checkbox" class="product-tile-select" aria-label="Select {{ $item }} to enquire about">
                <span class="material-symbols-outlined product-tile-checkbox-icon" aria-hidden="true">add</span>
              </label>
              <button type="button" class="product-tile surface hover-lift">
                <span class="product-tile-icon icon-tile material-symbols-outlined" aria-hidden="true">{{ $category['icon'] }}</span>
                <span class="product-tile-name">{{ $item }}</span>
                <span class="product-tile-tag">{{ $category['title'] }}</span>
              </button>
            </div>
          @endforeach
        @endforeach
      </div>

      <nav class="pagination" id="product-pagination" aria-label="Products pagination" hidden>
        <button type="button" class="pagination-btn pagination-arrow surface" id="pagination-prev" aria-label="Previous page">
          <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
        </button>
        <div class="pagination-pages" id="pagination-pages"></div>
        <button type="button" class="pagination-btn pagination-arrow surface" id="pagination-next" aria-label="Next page">
          <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
        </button>
      </nav>
    </div>
  </section>

  <div class="product-selection-bar" id="product-selection-bar">
    <span class="product-selection-count" id="product-selection-count" aria-live="polite">0 products selected</span>
    <div class="product-selection-actions">
      <button type="button" class="btn btn-outline" id="product-selection-clear">Clear</button>
      <a class="btn btn-primary" id="product-selection-enquire" href="{{ route('contact') }}" data-contact-url="{{ route('contact') }}" data-topic="Industrial &amp; Mining Supplies">Enquire about selected</a>
    </div>
  </div>

  <div class="modal" id="product-modal" hidden>
    <div class="modal-backdrop" data-modal-dismiss></div>
    <div class="modal-dialog product-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="product-modal-title">
      <button type="button" class="modal-close" data-modal-dismiss aria-label="Close">
        <span class="material-symbols-outlined" aria-hidden="true">close</span>
      </button>
      <div class="product-modal-icon icon-tile">
        <span class="material-symbols-outlined" aria-hidden="true" id="product-modal-icon-glyph"></span>
      </div>
      <p class="product-modal-tag" id="product-modal-tag"></p>
      <h2 id="product-modal-title"></h2>
      <p class="product-modal-summary" id="product-modal-summary"></p>
      <a class="btn btn-primary" id="product-modal-enquire" href="{{ route('contact') }}" data-contact-url="{{ route('contact') }}" data-topic="Industrial &amp; Mining Supplies">Enquire about this product</a>
    </div>
  </div>

  @include('sections.quote-band')

@endsection
