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
        $enquiry = $request->safe()->except('website');

        Mail::to(config('company.contact.email'))->send(new ContactEnquiry($enquiry));

        return redirect()
            ->route('contact')
            ->with('status', 'Thank you. Your enquiry has been sent and our team will respond shortly.')
            ->withFragment('enquiry');
    }
}
