<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function about(): View
    {
        return view('about');
    }

    public function services(): View
    {
        return view('services');
    }

    public function products(): View
    {
        return view('products');
    }

    public function serviceDetail(string $slug): View
    {
        $service = collect(config('company.service_details'))
            ->firstWhere('slug', $slug);

        abort_unless($service, 404);

        $related = collect(config('company.services'))
            ->filter(fn (array $item) => ! empty($item['slug']) && $item['slug'] !== $slug)
            ->values();

        return view('service-detail', compact('service', 'related'));
    }

    public function contact(Request $request): View
    {
        // Deep links from a service/product "Enquire" button carry a topic
        // (must match a config('company.enquiry_topics') entry exactly) and
        // an optional subject to seed the message field.
        $topic = collect(config('company.enquiry_topics'))
            ->first(fn (string $option) => $option === $request->query('topic'));

        $prefillMessage = $topic && $request->filled('subject')
            ? "I'd like to enquire about {$request->query('subject')}.\n\n"
            : null;

        return view('contact', [
            'prefillTopic' => $topic,
            'prefillMessage' => $prefillMessage,
        ]);
    }
}
