<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function show(string $slug): Response
    {
        //$images = Image::all();
        $categoryId = DB::table('categories')->where('slug', $slug)->value('id');
        $images = DB::table('images')->where('category_id', $categoryId)->get();
        return Inertia::render('Images', [
            'images' => $images,
        ]);
    }
}
