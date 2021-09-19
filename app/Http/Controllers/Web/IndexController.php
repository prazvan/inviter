<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FileParser\JsonTextParserService;
use Illuminate\View\View;

/**
 * Invokable Controller
 *
 * Index Controller
 */
final class IndexController extends Controller
{
    /**
     * Just the mounting point for the App
     *
     * @return View
     */
    public function __invoke(): View
    {

        dd(JsonTextParserService::make()->setTest(0), JsonTextParserService::make()->setTest(1), JsonTextParserService::make()->setTest(2));




        dd('aici');


        return view('index');
    }
}
