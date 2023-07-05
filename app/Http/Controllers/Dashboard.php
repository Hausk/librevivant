<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Dashboard extends Controller
{
    public function home() {
        return Inertia::render('Admin/Home', [
        ]);
    }
    public function categories() {
        $categories = Category::with('pinnedImage')->get();
        return Inertia::render('Admin/Categories', [
            'categories' => $categories,
        ]);
    }
}
