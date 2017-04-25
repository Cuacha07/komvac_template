<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

class CmsAdminController extends Controller
{
    public function __construct() 
    {
        $this->middleware('CMSAuthenticate');
    }

    public function index()
    {
        return view('cms.home');
    }
}
