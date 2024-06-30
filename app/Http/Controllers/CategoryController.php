<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index() : Response
    {
        $categories = Category::all();
        return Inertia::render('Category/Index', compact('categories'));
    }

    public function create()
    {
        $category = new Category();
        return Inertia::render('Category/Save', compact('category'));
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
        return Inertia::render('Category/Save', compact('category'));
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
