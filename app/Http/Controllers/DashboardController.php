<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Require authentication before rendering
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Only redirect
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('dashboard.general');
    }
}
