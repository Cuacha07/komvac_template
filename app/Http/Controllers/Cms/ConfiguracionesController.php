<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CMS\CMSConfiguration;

class ConfiguracionesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('CMSAuthenticate');
    }

    public function index()
    {
        return view('cms.configuraciones.index');
    }

    public function getContacto()
    {
        return response()->json(CMSConfiguration::first()->correo_contacto);
    }

    public function setContacto(Request $request)
    {
        $this->validate($request, ['correo' => 'required|email|max:255']);
        $conf = CMSConfiguration::first();
        $conf->correo_contacto = $request->input('correo');
        $conf->save();
        return response()->json(['success' => true]);
    }

    public function getMantenimiento()
    {
        return response()->json(CMSConfiguration::first()->front_site_up);
    }

    public function setMantenimiento(Request $request)
    {
        $conf = CMSConfiguration::first();
        $conf->front_site_up = $request->input('mantenimiento');
        $conf->save();
        return response()->json(['success' => true]);
    }

    public function getBackgroundLogin()
    {
        return response()->json(CMSConfiguration::first()->login_background_url);
    }

    public function setBackgroundLogin(Request $request)
    {
        $conf = CMSConfiguration::first();
        $paths = $this->uploadImage($request->file('background'));
        $conf->login_background_url = $paths;
        $conf->save();
        return response()->json(['success' => true]);
    }

    protected function uploadImage($file)
    {       
        //Directories
        $directory_name = "media-manager";
        $directory      = $directory_name."/cms";

        //Save Imagen
        $file_name = "backlogin.".$file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $file_name, 'public');

        return $path;
    }

    public function getTema()
    {
        $conf = CMSConfiguration::first();
        $resArray = [
            'template_skin' => $conf->template_skin, 
            'template_layout_options' => $conf->template_layout_options
        ];
        return response()->json($resArray);
    }

    public function setTema(Request $request)
    {
        $conf = CMSConfiguration::first();
        $conf->template_skin = $request->input('template_skin');
        $conf->template_layout_options = $request->input('template_layout_options');
        $conf->save();
        return response()->json(['success' => true]);
    }
}
