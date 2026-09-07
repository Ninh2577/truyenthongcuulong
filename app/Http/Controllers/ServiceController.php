<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $mediaServices = Service::where('group', 'media')->orderBy('order')->get();
        $techServices = Service::where('group', 'technology')->orderBy('order')->get();

        return view('services.index', compact('mediaServices', 'techServices'));
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $otherServices = Service::where('id', '!=', $service->id)->take(4)->get();

        return view('services.show', compact('service', 'otherServices'));
    }
}