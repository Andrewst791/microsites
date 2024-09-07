<?php

namespace App\Http\Controllers;

use App\Constants\PermissionSlug;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {
        return [
            new Middleware('permission:' . PermissionSlug::CATEGORIES_VIEW, only: ['index']),
            new Middleware('permission:' . PermissionSlug::CATEGORIES_CREATE, only: ['create', 'store']),
            new Middleware('permission:' . PermissionSlug::CATEGORIES_UPDATE, only: ['edit', 'update']),
            new Middleware('permission:' . PermissionSlug::CATEGORIES_DELETE, only: ['destroy']),
        ];
    }
    public function index() : Response
    {
        $categories = Category::all();
        return Inertia::render('Category/Index', compact('categories'));
    }

    public function create()
    {
        $category = new Category();
        $canEdit = true;
        return Inertia::render('Category/Save', compact('category', 'canEdit'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->back();
    }

    public function show(Category $category)
    {
    }

    public function edit(Category $category) : Response
    {
        $canEdit = true;
        return Inertia::render('Category/Save', compact('category', 'canEdit'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
    }

    public function destroy(Category $category) : RedirectResponse
    {
        $category->delete();
        return redirect()->back();
    }
}
