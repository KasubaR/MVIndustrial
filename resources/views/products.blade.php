@extends('layouts.app')

@section('title', 'Products | ' . config('company.short_name'))
@section('description', 'Industrial and mining supplies stocked and sourced by MV Industrial & Mining Supplies Limited: electrical items, bearings, drilling tools, welding equipment, fluid and valve systems, mechanical spares, safety equipment and hardware.')
@section('nav_active', 'products')

@section('content')

  <section class="page-header">
    <div class="page-header-media" aria-hidden="true">
      <img src="{{ asset('assets/images/services/supplies.jpg') }}" alt="">
      <span class="hero-veil"></span>
    </div>
    <div class="shell page-header-inner">
      <div class="page-header-copy">
        <p class="eyebrow">Our products</p>
        <h1>Industrial &amp; mining supplies, stocked and ready</h1>
        <p class="page-header-lead">{{ config('company.products_intro') }}</p>
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

        <div class="product-filter" id="product-filter">
          <button type="button" class="product-filter-trigger" id="product-filter-trigger" aria-haspopup="listbox" aria-expanded="false" aria-controls="product-filter-list">
            <span class="material-symbols-outlined" aria-hidden="true">filter_list</span>
            <span class="product-filter-label" id="product-filter-label">All categories</span>
            <span class="material-symbols-outlined product-filter-chevron" aria-hidden="true">expand_more</span>
          </button>
          <ul class="product-filter-list" id="product-filter-list" role="listbox" aria-label="Filter by category" tabindex="-1" hidden>
            <li role="option" aria-selected="true" class="is-selected" data-filter="all" data-label="All categories">All categories</li>
            @foreach (config('company.products') as $category)
              <li role="option" aria-selected="false" data-filter="{{ $category['slug'] }}" data-label="{{ $category['title'] }}">{{ $category['title'] }}</li>
            @endforeach
          </ul>
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
              <label class="product-tile-checkbox">
                <input type="checkbox" class="product-tile-select" aria-label="Select {{ $item }} to enquire about">
                <span class="material-symbols-outlined" aria-hidden="true">check</span>
              </label>
              <button type="button" class="product-tile">
                <span class="product-tile-icon material-symbols-outlined" aria-hidden="true">{{ $category['icon'] }}</span>
                <span class="product-tile-name">{{ $item }}</span>
                <span class="product-tile-tag">{{ $category['title'] }}</span>
              </button>
            </div>
          @endforeach
        @endforeach
      </div>

      <nav class="product-pagination" id="product-pagination" aria-label="Products pagination" hidden>
        <button type="button" class="pagination-btn pagination-arrow" id="pagination-prev" aria-label="Previous page">
          <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
        </button>
        <div class="pagination-pages" id="pagination-pages"></div>
        <button type="button" class="pagination-btn pagination-arrow" id="pagination-next" aria-label="Next page">
          <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
        </button>
      </nav>
    </div>
  </section>

  <div class="product-selection-bar" id="product-selection-bar">
    <span class="product-selection-count" id="product-selection-count">0 products selected</span>
    <div class="product-selection-actions">
      <button type="button" class="btn btn-outline" id="product-selection-clear">Clear</button>
      <a class="btn btn-primary" id="product-selection-enquire" href="{{ route('contact') }}" data-contact-url="{{ route('contact') }}" data-topic="Industrial &amp; Mining Supplies">Enquire about selected</a>
    </div>
  </div>

  <div class="product-modal" id="product-modal" hidden>
    <div class="product-modal-backdrop" data-modal-dismiss></div>
    <div class="product-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="product-modal-title">
      <button type="button" class="product-modal-close" id="product-modal-close" aria-label="Close">
        <span class="material-symbols-outlined" aria-hidden="true">close</span>
      </button>
      <div class="product-modal-icon">
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
