<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use RahulHaque\Filepond\Models\Filepond;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $categories = Category::all();
        return Inertia::render('Works', [
            'categories' => $categories,
        ]);
    }
    public function show(): Response
    {
        $images = Filepond::all();
        return Inertia::render('Images', [
            'images' => $images,
        ]);
    }
}
