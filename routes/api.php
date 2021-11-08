<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AuthController, XScanHostsController, XScanPortsController, XScanHistoryPortsController, PanelController
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login'])->name('api.login');

Route::group([

    'middleware' => 'apiJWT',
    'prefix' => 'system',
    'namespace' => "Api",
    'as' => 'api.'

], function ($router) {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // XScanHostsController
    Route::post('get-host', [XScanHostsController::class, 'get_one_host'])->name('get-host');
    Route::post('inactive-host', [XScanHostsController::class, 'inactive_host'])->name('inactive-host');
    Route::delete('delete-host', [XScanHostsController::class, 'delete_host'])->name('delete-host');
    Route::put('create-host', [XScanHostsController::class, 'create_host'])->name('create-host');

    // XScanPortsController
    Route::post('get-port', [XScanPortsController::class, 'get_one_port'])->name('get-port');
    Route::post('create-port-scan', [XScanPortsController::class, 'create_port_scan'])->name('create-port-scan');
    Route::delete('delete-port-scan', [XScanPortsController::class, 'delete_port_scan'])->name('delete-port-scan');

    // XScanHistoryPortsController
    Route::post('get-history', [XScanHistoryPortsController::class, 'get_one_history_port'])->name('get-history');
    Route::post('get-history-panel', [XScanHistoryPortsController::class, 'get_history_panel'])->name('get-history-panel');

    // PanelController
    Route::post('get-count', [PanelController::class, 'get_count'])->name('get-count');
});
