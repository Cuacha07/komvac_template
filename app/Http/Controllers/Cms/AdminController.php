<?php

namespace App\Http\Controllers\CMS;

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
