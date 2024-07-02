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
        $canEdit = true;
        return Inertia::render('Site/Save', compact('site', 'categories', 'document_types', 'canEdit'));
    }

    public function store(StoreSiteRequest $request) : RedirectResponse
    {
        Site::create($request->validated());
        return redirect()->back();
    }

    public function show(Site $site) : Response
    {
        $categories = Category::get();
        $document_types = array_column(DocumentTypes::cases(), 'name');
        $canEdit = false;
        return Inertia::render('Site/Save', compact('site', 'categories', 'document_types', 'canEdit'));
    }

    public function edit(Site $site) : Response
    {
        $categories = Category::get();
        $document_types = array_column(DocumentTypes::cases(), 'name');
        $canEdit = true;
        return Inertia::render('Site/Save', compact('site', 'categories', 'document_types', 'canEdit'));
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
