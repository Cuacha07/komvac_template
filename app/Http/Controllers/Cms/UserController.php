<?php

namespace App\Http\Controllers\CMS;

use Carbon\Carbon;
use App\CMSUser;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('cms.users.index');
    }
}
