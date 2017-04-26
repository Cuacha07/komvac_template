<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct() 
    {
        $this->middleware('CMSAuthenticate');
    }

    public function home()
    {
        return view('cms.home');
    }
}
