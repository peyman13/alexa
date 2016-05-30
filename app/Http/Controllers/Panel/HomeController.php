<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Panel\MainController as MainController;
use DB;


class HomeController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // main dashbord for home page view
        return view('admin_panel.component.home',['title' => 'Home',
                                                  'titleSmall' =>""]);
    }
}
