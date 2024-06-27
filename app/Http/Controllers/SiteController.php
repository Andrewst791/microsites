<?php

namespace App\Http\Controllers;

use App\Constants\DocumentTypes;
use App\Models\Category;
use App\Models\Site;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SiteController extends Controller
{
    public function index() : Response
    {
        $sites = Site::with('category')->get();
        return Inertia::render('Site/Index', compact('sites'));
    }

    public function create() : Response
    {
        $categories = Category::get();
        $document_types = array_column(DocumentTypes::cases(), 'name');
        $site = new Site();
        return Inertia::render('Site/Save', compact('site', 'categories', 'document_types'));
    }

    public function store(StoreSiteRequest $request) : RedirectResponse
    {
        Site::create($request->validated());
        return redirect()->back();
    }

    public function show(Site $site) : Response
    {
        return Inertia::render('Site/Save', compact('site'));
    }

    public function edit(Site $site) : Response
    {
        $categories = Category::get();
        $document_types = array_column(DocumentTypes::cases(), 'name');
        return Inertia::render('Site/Save', compact('site', 'categories', 'document_types'));
    }

    public function update(UpdateSiteRequest $request, Site $site) : RedirectResponse
    {
        $site->update($request->validated());
        return redirect()->back();
    }

    public function destroy(Site $site) : RedirectResponse
    {
        $site->delete();
        return redirect()->back();
    }
}
