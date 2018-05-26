<?php

namespace App\Http\Controllers\CMS;

use Carbon\Carbon;
use App\CMSUser;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CMS\CMSUsersRequest;
use App\Http\Requests\CMS\CMSUsersUpdateRequest;
use App\Http\Requests\CMS\CMSUsersPasswordRequest;
use App\Http\Controllers\Controller;
use Hash;
use Storage;

class UserController extends Controller
{
    public function __construct() 
    {
        $this->middleware('CMSAuthenticate');
    }

    public function index()
    {
        return view('cms.users.index');
    }

    public function getUsers(Request $request)
    {
        if($request->has('tipo') && $request->has('busqueda')) {

            $tipo = $request->input('tipo');
            $busqueda = $request->input('busqueda');

            $results = CMSUser::where($tipo, 'LIKE', $busqueda.'%')
            ->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $results = CMSUser::orderBy('created_at', 'desc')->paginate(20);
        }

        return response()->json($results);
    }

    public function setUser(CMSUsersRequest $request)
    {
        $user = CMSUser::create([
            'name'     => $request->input('name'),
            'avatar'   => 'img/cms/pug.png',
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'type'     => $request->input('type')
        ]);

        //Upload Avatar
        if($request->hasFile('avatar')) {
            $user->avatar = $this->updateAvatar($request->file('avatar'), $user->id);
            $user->save();
        }
    }

    public function updateUser(CMSUsersUpdateRequest $request)
    {
        $user = CMSUser::findOrFail($request->input('id'));

        //Update
        $user->fill([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'type'  => $request->input('type')
        ]);

        $user->save();

        //Update Avatar
        if($request->hasFile('avatar')) {
            $user->avatar = $this->updateAvatar($request->file('avatar'), $user->id);
            $user->save();
        }
    }

    public function updatePassword(CMSUsersPasswordRequest $request)
    {   
        $user = CMSUser::findOrFail($request->input('id'));
        $user->password = Hash::make($request->input('password'));
        $user->save();
    }

    protected function updateAvatar($file, $user_id)
    {       
        //Directories
        $directory_name = "media-manager";
        $directory      = $directory_name."/cms_users/".$user_id;

        //Filename
        $file_name = $user_id."_avatar.".$file->getClientOriginalExtension();

        //Store the file
        $path = $file->storeAs($directory, $file_name, 'public');

        return $path;
    }

    public function defaultAvatar(Request $request)
    {
        $user = CMSUser::findOrFail($request->input('id'));
        $user->avatar = "img/cms/pug.png";
        $user->save();
    }

    public function deleteUser(Request $request)
    {
        $user = CMSUser::findOrFail($request->input('id'));

        //Same User Block Validation
        if(Auth::guard('cms')->user()->id == $user->id) {
            return response()->json("Error you are the same.");
        }

        Storage::deleteDirectory("media-manager/cms_users/".$user->id);
        $user->delete();
    }

    public function toggleBlock(Request $request)
    {
        $user = CMSUser::findOrFail($request->input('id'));

        //Same User Block Validation
        if(Auth::guard('cms')->user()->id == $user->id) {
            return response()->json("Error you are the same.");
        }

        if ($user->blocked_at == null) {
            $user->blocked_at = Carbon::now();
        } else { $user->blocked_at = null; }
        $user->save();
        return response()->json($user->blocket_at);
    }
}