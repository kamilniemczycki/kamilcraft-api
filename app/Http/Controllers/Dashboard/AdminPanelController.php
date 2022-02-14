<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPanelController extends Controller
{

    public function __construct(

    ) {}

    public function __invoke(Request $request): View
    {
        return view('dashboard.home');
    }

}
