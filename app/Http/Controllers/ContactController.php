<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request): RedirectResponse
    {
        // The optional fields are absent from the validated data when a client
        // omits them rather than posting them empty, so default them here and
        // let the mail template rely on every key existing.
        $enquiry = [
            'phone' => null,
            'company' => null,
            ...$request->safe()->except('website'),
        ];

        Mail::to(config('company.contact.email'))->send(new ContactEnquiry($enquiry));

        return redirect()
            ->route('contact')
            ->with('status', 'Thank you. Your enquiry has been sent and our team will respond shortly.')
            ->withFragment('enquiry');
    }
}
