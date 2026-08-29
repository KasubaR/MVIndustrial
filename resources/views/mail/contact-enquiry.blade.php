New enquiry from the {{ config('company.short_name') }} website.

Service: {{ $enquiry['topic'] }}
Name: {{ $enquiry['name'] }}
Email: {{ $enquiry['email'] }}
Phone: {{ $enquiry['phone'] ?: 'Not supplied' }}
Company: {{ $enquiry['company'] ?: 'Not supplied' }}

Message:
{{ $enquiry['message'] }}
