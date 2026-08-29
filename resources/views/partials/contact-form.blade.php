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

  <div class="field">
    <label for="topic">What do you need? <span aria-hidden="true">*</span></label>
    <select id="topic" name="topic" required
            @error('topic') aria-invalid="true" aria-describedby="topic-error" @enderror>
      <option value="">Select a service</option>
      @foreach (config('company.enquiry_topics') as $topic)
        <option value="{{ $topic }}" @selected(old('topic') === $topic)>{{ $topic }}</option>
      @endforeach
    </select>
    @error('topic')
      <span class="field-error" id="topic-error">{{ $message }}</span>
    @enderror
  </div>

  <div class="field">
    <label for="message">Details of your requirement <span aria-hidden="true">*</span></label>
    <textarea id="message" name="message" rows="6" required
              @error('message') aria-invalid="true" aria-describedby="message-error" @enderror>{{ old('message') }}</textarea>
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
