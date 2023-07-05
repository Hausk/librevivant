<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorksController;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use RahulHaque\Filepond\Facades\Filepond;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $categories = Category::all();
    return Inertia::render('Dashboard', [
        'categories' => $categories,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/category', [ImageController::class, 'index'])->name('category.index');
    Route::post('/category', [ImageController::class, 'store'])->name('category.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/admin/home', [Dashboard::class, 'home'])->name('admin.home');
    Route::get('/dashboard/admin/categories', [Dashboard::class, 'categories'])->name('admin.categories');
});
Route::get('/works', [WorksController::class, 'index']);
Route::get('/work/{slug}', [WorksController::class, 'show']);
Route::put('/admin/upload', function (Request $request) {
    // Validate the submitted fields
    // Put this in Request class
    // or Controller method
    $request->validate([
        'category' => 'required|max:100',
        'gallery' => 'required',
        'gallery.*' => [
            'required',
            Rule::filepond([
                'max:50000',
                'image:jpeg,png',
            ]),
        ],
    ]);

    // Process the files using Filepond package
    // and move them to your preferred storage
    // i.e. "./storage/app/public/avatars"
    // dd($fileInfo) or dd($galleryInfo)
    $fileName = time() + auth()->id();
    $galleries = Filepond::field($request->gallery)->moveTo('galleries/' . $fileName);
    $category = $request->category;
    foreach ($galleries as $gallery) {
        $image = new Image();
        $image->filename = $gallery['basename'];
        $image->filepath = $gallery['location'];
        $image->created_by = auth()->id();
        $image->category_id = $category;
        $image->save();
    }

    return redirect()->back()->with('message', 'Les images ont été envoyées');
})->name('upload-images');
require __DIR__.'/auth.php';
