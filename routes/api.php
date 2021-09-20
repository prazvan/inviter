<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\InviteesCollection;
use App\Repositories\AffiliateRepository;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public api routes
Route::post('/upload', App\Http\Controllers\Api\UploadController::class);

// Resource collection
Route::redirect('/invitees', '/',Symfony\Component\HttpFoundation\Response::HTTP_MOVED_PERMANENTLY);

// resource route
Route::get('/invitees/{list_type?}', function ($list_type)
{
    // php 8 match would have been nice here
    switch ($list_type)
    {
        case 'blacklist':
            $eligible = false;
        break;
        case 'whitelist':
        default:
            $eligible = true;
        break;
    }

    $data = AffiliateRepository::make()->getAll($eligible);

    // return json collection
    return InviteesCollection::make($data)->toJson();
});
