<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use Inertia\Inertia;
use Inertia\Response;

class SiteController extends Controller
{
    public function index() : Response
    {
        $sites = Site::with('category')->get();
        return Inertia::render('Site/Index', compact('sites'));
    }

    public function create()
    {
    }

    public function store(StoreSiteRequest $request)
    {
    }

    public function show(Site $site)
    {
    }

    public function edit(Site $site)
    {
    }

    public function update(UpdateSiteRequest $request, Site $site)
    {
    }

    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->back();
    }
}
