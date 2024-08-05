<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index() : Response
    {
        $sites = Site::get();
        return Inertia::render('Home', compact('sites'));
    }
}
