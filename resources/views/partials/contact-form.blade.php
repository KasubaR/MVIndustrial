@if (session('status'))
  <p class="form-status" role="status">
    <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
    {{ session('status') }}
  </p>
@endif

@if ($errors->any())
  <p class="form-status form-status-error" role="alert">
    <span class="material-symbols-outlined" aria-hidden="true">error</span>
    Please correct the highlighted fields and try again.
  </p>
@endif

<form class="enquiry-form" method="POST" action="{{ route('contact.send') }}" novalidate>
  @csrf

  <div class="field-row">
    <div class="field">
      <label for="name">Full name <span aria-hidden="true">*</span></label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required
             @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
      @error('name')
        <span class="field-error" id="name-error">{{ $message }}</span>
      @enderror
    </div>

    <div class="field">
      <label for="email">Email address <span aria-hidden="true">*</span></label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" required
             @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
      @error('email')
        <span class="field-error" id="email-error">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="field-row">
    <div class="field">
      <label for="phone">Phone number</label>
      <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"
             @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror>
      @error('phone')
        <span class="field-error" id="phone-error">{{ $message }}</span>
      @enderror
    </div>

    <div class="field">
      <label for="company">Company</label>
      <input type="text" id="company" name="company" value="{{ old('company') }}" autocomplete="organization"
             @error('company') aria-invalid="true" aria-describedby="company-error" @enderror>
      @error('company')
        <span class="field-error" id="company-error">{{ $message }}</span>
      @enderror
    </div>
  </div>

  @php($topicValue = old('topic', $prefillTopic ?? ''))
  <div class="field">
    <span class="field-label" id="topic-label">What do you need? <span aria-hidden="true">*</span></span>
    <div class="product-filter" id="topic-select">
      <button type="button" class="product-filter-trigger" id="topic-trigger"
              aria-haspopup="listbox" aria-expanded="false" aria-controls="topic-list" aria-labelledby="topic-label topic-select-label"
              @error('topic') aria-invalid="true" aria-describedby="topic-error" @enderror>
        <span class="product-filter-label" id="topic-select-label">{{ $topicValue !== '' ? $topicValue : 'Select a service' }}</span>
        <span class="material-symbols-outlined product-filter-chevron" aria-hidden="true">expand_more</span>
      </button>
      <ul class="product-filter-list" id="topic-list" role="listbox" aria-label="What do you need?" tabindex="-1" hidden>
        @foreach (config('company.enquiry_topics') as $topic)
          <li role="option" aria-selected="{{ $topicValue === $topic ? 'true' : 'false' }}" @class(['is-selected' => $topicValue === $topic]) data-value="{{ $topic }}" data-label="{{ $topic }}">{{ $topic }}</li>
        @endforeach
      </ul>
      <input type="hidden" id="topic" name="topic" value="{{ $topicValue }}">
    </div>
    @error('topic')
      <span class="field-error" id="topic-error">{{ $message }}</span>
    @enderror
  </div>

  <div class="field">
    <label for="message">Details of your requirement <span aria-hidden="true">*</span></label>
    <textarea id="message" name="message" rows="6" required
              @error('message') aria-invalid="true" aria-describedby="message-error" @enderror>{{ old('message', $prefillMessage ?? '') }}</textarea>
    @error('message')
      <span class="field-error" id="message-error">{{ $message }}</span>
    @enderror
  </div>

  {{-- Honeypot: hidden from users, tempting to bots. --}}
  <div class="field-honeypot" aria-hidden="true">
    <label for="website">Leave this field empty</label>
    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
  </div>

  <button class="btn btn-primary btn-lg" type="submit">Send Enquiry</button>
</form>
