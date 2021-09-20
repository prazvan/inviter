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
        return view('index');
    }
}
