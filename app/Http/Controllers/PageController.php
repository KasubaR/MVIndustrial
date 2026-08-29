<?php

namespace App\Http\Controllers;

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

    public function contact(): View
    {
        return view('contact');
    }
}
