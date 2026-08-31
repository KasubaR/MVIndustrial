@php($contact = config('company.contact'))
@php($social = config('company.social'))
<footer class="site-footer">
  <div class="shell footer-grid">
    <div>
      <a class="brand" href="{{ route('home') }}">
        <img class="brand-logo footer-logo" src="{{ asset('assets/mv-logo-mark.svg') }}" alt="{{ config('company.name') }}" width="220" height="67">
      </a>
      <p class="footer-note">
        {{ config('company.name') }} &middot; Company Registration No. {{ config('company.registration_number') }}<br>
        Incorporated in the Republic of Zambia, {{ config('company.incorporated_on') }}.
      </p>
    </div>

    <div class="footer-social">
      <h3>Follow us</h3>
      <p>Keep up with projects, supply updates and vacancies.</p>
      <ul class="social-links">
        @if ($social['facebook'])
          <li>
            <a class="icon-tile icon-tile-circle hover-lift" href="{{ $social['facebook'] }}" aria-label="MV Industrial on Facebook" rel="noopener" target="_blank">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true" focusable="false">
                <path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.52 1.49-3.91 3.77-3.91 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.78-1.63 1.57v1.89h2.78l-.44 2.91h-2.34V22c4.78-.76 8.44-4.92 8.44-9.94Z"/>
              </svg>
            </a>
          </li>
        @endif
        @if ($social['linkedin'])
          <li>
            <a class="icon-tile icon-tile-circle hover-lift" href="{{ $social['linkedin'] }}" aria-label="MV Industrial on LinkedIn" rel="noopener" target="_blank">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true" focusable="false">
                <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3V9Zm7 0h3.83v1.64h.05c.53-.96 1.83-1.97 3.77-1.97 4.03 0 4.78 2.5 4.78 5.76V21h-4v-5.62c0-1.34-.03-3.07-1.95-3.07-1.95 0-2.25 1.46-2.25 2.97V21h-4V9Z"/>
              </svg>
            </a>
          </li>
        @endif
        @if ($social['whatsapp'])
          <li>
            <a class="icon-tile icon-tile-circle hover-lift" href="{{ $social['whatsapp'] }}" aria-label="Message MV Industrial on WhatsApp" rel="noopener" target="_blank">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true" focusable="false">
                <path d="M12.04 2C6.6 2 2.2 6.4 2.2 11.84c0 1.94.53 3.76 1.45 5.32L2 22l4.98-1.6a9.8 9.8 0 0 0 5.06 1.4h.01c5.43 0 9.84-4.4 9.84-9.84C21.89 6.4 17.48 2 12.04 2Zm0 17.96h-.01a8.2 8.2 0 0 1-4.16-1.14l-.3-.18-2.95.95.96-2.88-.2-.31a8.14 8.14 0 0 1-1.25-4.36c0-4.51 3.68-8.18 8.2-8.18 2.19 0 4.25.86 5.8 2.4a8.13 8.13 0 0 1 2.4 5.79c0 4.52-3.68 8.19-8.19 8.19Zm4.5-6.13c-.25-.13-1.46-.72-1.68-.8-.23-.08-.39-.13-.56.12-.16.25-.64.8-.78.97-.15.16-.29.19-.53.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.15-.25-.02-.38.11-.5.11-.12.25-.29.37-.44.13-.15.17-.25.25-.42.09-.16.04-.31-.02-.43-.06-.13-.56-1.34-.76-1.84-.2-.48-.41-.42-.56-.42h-.48c-.16 0-.43.06-.65.31-.23.25-.86.84-.86 2.05 0 1.2.88 2.37 1 2.53.13.16 1.74 2.65 4.2 3.72.59.25 1.05.4 1.4.52.6.19 1.13.16 1.56.1.48-.07 1.46-.6 1.67-1.18.2-.58.2-1.07.14-1.18-.06-.11-.22-.17-.47-.29Z"/>
              </svg>
            </a>
          </li>
        @endif
      </ul>
    </div>

    <div class="footer-contact">
      <h3>Get in touch</h3>
      <p>{{ $contact['short_address'] }}</p>
      <p><a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></p>
      <p><a href="tel:{{ str_replace(' ', '', $contact['phones'][0]) }}">{{ $contact['phones'][0] }}</a></p>
      @if ($social['whatsapp'])
        <p>
          <a class="footer-whatsapp" href="{{ $social['whatsapp'] }}" rel="noopener" target="_blank">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true" focusable="false">
              <path d="M12.04 2C6.6 2 2.2 6.4 2.2 11.84c0 1.94.53 3.76 1.45 5.32L2 22l4.98-1.6a9.8 9.8 0 0 0 5.06 1.4h.01c5.43 0 9.84-4.4 9.84-9.84C21.89 6.4 17.48 2 12.04 2Zm0 17.96h-.01a8.2 8.2 0 0 1-4.16-1.14l-.3-.18-2.95.95.96-2.88-.2-.31a8.14 8.14 0 0 1-1.25-4.36c0-4.51 3.68-8.18 8.2-8.18 2.19 0 4.25.86 5.8 2.4a8.13 8.13 0 0 1 2.4 5.79c0 4.52-3.68 8.19-8.19 8.19Zm4.5-6.13c-.25-.13-1.46-.72-1.68-.8-.23-.08-.39-.13-.56.12-.16.25-.64.8-.78.97-.15.16-.29.19-.53.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.15-.25-.02-.38.11-.5.11-.12.25-.29.37-.44.13-.15.17-.25.25-.42.09-.16.04-.31-.02-.43-.06-.13-.56-1.34-.76-1.84-.2-.48-.41-.42-.56-.42h-.48c-.16 0-.43.06-.65.31-.23.25-.86.84-.86 2.05 0 1.2.88 2.37 1 2.53.13.16 1.74 2.65 4.2 3.72.59.25 1.05.4 1.4.52.6.19 1.13.16 1.56.1.48-.07 1.46-.6 1.67-1.18.2-.58.2-1.07.14-1.18-.06-.11-.22-.17-.47-.29Z"/>
            </svg>
            {{ $contact['phones'][0] }}
          </a>
        </p>
      @endif
    </div>
  </div>
  <div class="shell footer-bottom">
    <p>&copy; {{ date('Y') }} {{ config('company.name') }}. All rights reserved.</p>
    <p>Registered in Zambia &middot; Quality &amp; Safety Committed</p>
    <a class="footer-credit" href="https://kinpinarts.com/" rel="noopener" target="_blank">
      Powered by
      <img src="{{ asset('assets/kinpinarts-logo.svg') }}" alt="Kinpin Arts" width="72" height="25">
    </a>
  </div>
</footer>
