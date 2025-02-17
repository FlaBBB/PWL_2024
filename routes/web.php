<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\FirstMiddleware;
use App\Http\Middleware\SecondMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([FirstMiddleware::class, SecondMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get("/hello", [WelcomeController::class, "hello"]);
    Route::get("/world", function () {
        return "Zawarudo!! <br><img src='https://media.tenor.com/tavWcDr9TiMAAAAM/za-warudo.gif' alt='zawarudo' />";
    });
    Route::get("/about", function () {
        return "My name is Fikri Muhammad  Abdillah, My NIM is 2341720092";
    })->name("about");

    Route::get("/user/profile", function () {
        return redirect()->route("about");
    })
        ->name("profile");

    Route::get("/user/{name?}", function ($name = null) {
        return "Nama saya " . $name;
    });

    Route::get("/posts/{post}/comments/{comment}", function ($postId, $commentId) {
        return "Post ke-" . $postId . " Komentar ke-: " . $commentId;
    });

    Route::domain("{account}.example.com")->group(function () {
        Route::get('user/{id}', function ($account, $id) {});
    });

    Route::middleware(AuthMiddleware::class)->group(function () {
        Route::get("/user", [UserController::class, "index"]);
        Route::get("/post", [PostController::class, "index"]);
        Route::get("/event", [EventController::class, "index"]);
    });

    Route::prefix("admin")->group(function () {
        Route::get("/user", [UserController::class, "index"]);
        Route::get("/post", [PostController::class, "index"]);
        Route::get("/event", [EventController::class, "index"]);
    });
});

Route::get('mahasiswa', function () {});
Route::post('mahasiswa', function () {});
Route::put('mahasiswa', function () {});
Route::delete('mahasiswa', function () {});
Route::get('mahasiswa/{id}', function ($id) {});
Route::put('mahasiswa/{id}', function ($id) {});
Route::delete('mahasiswa/{id}', function ($id) {});

Route::match(['get', 'post'], '/specialUrl', function () {});
Route::any('/specialMahasiswa', function () {});

Route::get('/greeting', [WelcomeController::class, "greeting"]);
