<?php

namespace App\Http\Controllers;

use App\Actions\Site\StoreAction;
use App\Actions\Site\UpdateAction;
use App\Constants\DocumentTypes;
use App\Constants\InputType;
use App\Constants\PermissionSlug;
use App\Constants\SiteTypes;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Site;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class SiteController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::SITES_VIEW_ANY), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::SITES_CREATE), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::SITES_UPDATE), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::SITES_DELETE), only: ['destroy']),
        ];
    }
    public function index() : Response
    {
        $user = Auth::user();
        $sites = Site::with('category')
            ->getSitesByRole($user)
            ->get();
        return Inertia::render('Site/Index', compact('sites'));
    }

    public function create() : Response
    {
        $categories = Category::get();
        $currencies = Currency::get();
        $document_types = array_column(DocumentTypes::cases(), 'name');
        $site_types = array_column(SiteTypes::cases(), 'name');
        $site = new Site();
        $input_types = array_column(InputType::cases(), 'name');
        $canEdit = true;
        return Inertia::render('Site/Save', compact('site', 'categories', 'currencies', 'document_types', 'site_types', 'canEdit', 'input_types'));
    }

    public function store(StoreSiteRequest $request, StoreAction $storeAction) : RedirectResponse
    {
        $storeAction->execute($request->validated());
        return redirect()->to(route('sites.index'));
    }

    public function show(Site $site) : Response
    {
        $categories = Category::get();
        $currencies = Currency::get();
        $document_types = array_column(DocumentTypes::cases(), 'name');
        $site_types = array_column(SiteTypes::cases(), 'name');
        $input_types = array_column(InputType::cases(), 'name');
        $canEdit = false;
        return Inertia::render('Site/Save', compact('site', 'categories', 'currencies', 'document_types', 'site_types', 'canEdit', 'input_types'));
    }

    public function edit(Site $site) : Response
    {
        $categories = Category::get();
        $currencies = Currency::get();
        $site_types = array_column(SiteTypes::cases(), 'name');
        $document_types = array_column(DocumentTypes::cases(), 'name');
        $canEdit = true;
        $input_types = array_column(InputType::cases(), 'name');
        return Inertia::render('Site/Save', compact('site', 'categories', 'currencies', 'site_types', 'document_types', 'canEdit', 'input_types'));
    }

    public function update(UpdateSiteRequest $request, Site $site, UpdateAction $updateAction) : RedirectResponse
    {
//        $site->update($request->validated());
        $updateAction->execute($site, $request->validated());
        return redirect()->back();
    }

    public function destroy(Site $site) : RedirectResponse
    {
        $site->delete();
        return redirect()->back();
    }

    public function payment(string|int $slugId) : Response
    {
        $site = Site::findBySlugOrId($slugId)->firstOrFail();;
        $site->load(['category', 'currency']);
        return Inertia::render('Site/Payment', compact('site'));
    }
}
