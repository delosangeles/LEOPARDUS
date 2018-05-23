<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Settings;

use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;

class AdminController extends Controller
{
	function __construct()
	{
        // TITLE
		view()->share('title', 'Panel de administración');
	}

    public function index()
    {
        // DO MENU
        view()->share('do', collect(['name' => 'inicio', 'text' => 'Inicio']));
        //
    	return view('dashboard.index');
    }

    public function settings()
    {
        // TITLE
    	view()->share('title', 'Configuración del sistema');

        // DO MENU
        view()->share('do', 
            collect(['name' => 'sistema', 'text' => 'Sistema']));
        
        //
    	return view('dashboard.settings');
    }

    public function updateSettings(Request $request)
    {
        try {
            //
            $validator = \Validator::make($request->all(), [
                'name' => 'required',
                'slogan' => 'required',
                'site_email' => 'required',
                'description' => 'required',
                'status_web' => 'required',
                'register' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()
                            ->route('admin.settings')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Obtenemos la configuración del sistema.
            $settings = Settings::first();

            // Actualizamos la data.
            $settings->name = $request->name;
            $settings->slogan = $request->slogan;
            $settings->category_type = $request->category_type;
            $settings->company_name = $request->company_name;
            $settings->company_email = $request->company_email;
            $settings->site_email = $request->site_email;
            $settings->description = $request->description;
            $settings->enable_register = $request->register === 1 ? true : false;
            $settings->status_web = $request->status_web === 1 ? true : false;
            $settings->save();

            // .ENV
            $env = new DotenvEditor();

            try{
                // Comprobamos si ya se configuro el .env
                $is_configured = $env->getValue("DB_DATABASE") == 'homestead' ? false : true;

                // Cambiamos el .env
                $env->changeEnv([
                   'FB_ID'   => $request->input('bd'),
                   'FB_SECRET'   => $request->input('user'),
                   'TW_ID'   => $request->input('bd'),
                   'TW_SECRET'   => $request->input('user'),
                   'GOOGLE_ID'   => $request->input('bd'),
                   'GOOGLE_SECRET'   => $request->input('user')
                ]);

            }catch(DotEnvException $e){
                //
                return redirect()
                    ->back()
                    ->with('error', $e->getMessage())
                    ->withInput();
            }

            // redirect
            return redirect()
                ->back()
                ->withAction('updated'); 

        } catch (Exception $e) {
            //
            return redirect()
                ->back()
                ->with('error', $e)
                ->withInput();
        }
    }

    public function auth()
    {
        try{
            //
            $env = new DotenvEditor();

            $socialite_settings = collect([
                'facebook' => collect([
                    'client_id'     => $env->getValue('FB_ID'),
                    'client_secret' => $env->getValue('FB_SECRET'),
                ]),
                'twitter' => collect([
                    'client_id'     => $env->getValue('TW_ID'),
                    'client_secret' => $env->getValue('TW_SECRET'),
                ]),
                'google' => collect([
                    'client_id'     => $env->getValue('GOOGLE_ID'),
                    'client_secret' => $env->getValue('GOOGLE_SECRET'), 
                ])
            ]);

            // Socialite Settings
            view()->share(compact('socialite_settings'));

            // TITLE
            view()->share('title', 'Configuración de autenticado');
            // DO MENU
            view()->share('do', 
                collect(['name' => 'auth', 'text' => 'Autenticación']));
            //
            return view('dashboard.auth');

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function updateAuth(Request $request)
    {
        switch ($request->provider) {
            case 'facebook':
                $_prefix = 'FB';
                break;
            case 'google':
                $_prefix = 'GOOGLE';
                break;
            case 'twitter':
                $_prefix = 'TW';                
                break;
            default:
                return redirect()->back();
                break;
        }

        $validator = \Validator::make($request->all(), [
            $request->provider . '_secret_key' => 'required',
            $request->provider . '_public_key' => 'required',
            $request->provider . '_enable_auth' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // .ENV
        $env = new DotenvEditor();

        try{
            // Cambiamos el .env
            $env->changeEnv([
                $_prefix . '_ID'   => $request->input($request->provider . '_public_key'),
                $_prefix . '_SECRET'   => $request->input($request->provider . '_secret_key'),
            ]);

            // Cambiamos las configuraciones
            $settings = Settings::first();
            $settings->{'enable_auth_' . strtolower($_prefix)} = $request->input($request->provider . '_enable_auth');
            $settings->save();

            // redirect
            return redirect()
                ->back()
                ->withAction('updated'); 

        }catch(DotEnvException $e){
            //
            return redirect()
            ->back()
            ->with('error', $e->getMessage())
            ->withInput();
        }
    }

    public function actionMenu(Request $request)
    {
        // TITLE
    	view()->share('title', 'Action menú');

        // DO MENU
        view()->share('do', 
            collect(['name' => 'action-menu', 'text' => 'Action Menú']));
        
        //
    	return view('dashboard.action_menu');
    }

    public function sidebar(Request $request)
    {
        // TITLE
        view()->share('title', 'Sidebar');

        // DO MENU
        view()->share('do', 
            collect(['name' => 'sidebar', 'text' => 'Sidebar']));
        
        //
        return view('dashboard.sidebar');
    }

    public function users()
    {
        // TITLE
        view()->share('title', 'Listado de usuarios');

        // DO MENU
        view()->share('do', 
            collect(['name' => 'users', 'text' => 'Usuarios']));
        
        //
        return view('dashboard.users');
    }

    public function roles()
    {
        // TITLE
        view()->share('title', 'Listado de roles');

        // DO MENU
        view()->share('do', 
            collect(['name' => 'roles', 'text' => 'Roles']));
        
        //
        return view('dashboard.roles');
    }

    public function permissions()
    {
        // TITLE
        view()->share('title', 'Listado de permisos');

        // DO MENU
        view()->share('do', 
            collect(['name' => 'permissions', 'text' => 'Permisos']));
        
        //
        return view('dashboard.permissions');
    }


    
}
