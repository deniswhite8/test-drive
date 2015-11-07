<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Auto\Mark;

/**
 * Search controller
 *
 * @package App\Http\Controllers\Client
 */
class SearchController extends Controller
{
    /**
     * Index action
     */
    public function index()
    {
        return view('client.search', [
            'marks' => Mark::all()
        ]);
    }
}
