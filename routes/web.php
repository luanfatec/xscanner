<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ {
    System\XScanHostsController,
    System\XScanPortsController,
    System\XScanHistoryPortsController,
    System\XScanProfileController,
    System\UserController,
    System\XScanPanelController
};

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

Route::get("/", function () {
    return redirect()->route('system.login.page');
})->name("welcome");


Route::group(["prefix" => "system", "namespace" => "System", "as" => "system."], function () {
    Route::get("/", [UserController::class, "login"])->name("login.page");
    Route::post("/auther", [UserController::class, "auther"])->name("login.auth");


    Route::middleware(['auth'])->group(function () {
        Route::get("home", [XScanPanelController::class, 'homepanel'])->name("home");
        Route::get("hosts", [XScanHostsController::class, 'hostspage'])->name("hosts");
        Route::get("ports", [XScanPortsController::class, 'portspage'])->name("ports");
        Route::get("history", [XScanHistoryPortsController::class, 'historypage'])->name("history");
        Route::get("profile", [XScanProfileController::class, 'profilepage'])->name("profile");


        // POSTS
        Route::put("update-user", [UserController::class, 'save_user'])->name('save.user');
    });

    Route::get("/logout", [UserController::class, "logout"])->name("login.logout");
});
