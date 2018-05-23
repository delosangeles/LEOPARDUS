<?php

namespace Modules\ReferralTree\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Auth;
use App\Settings;
use Modules\ReferralTree\Entities\User;

class ReferralTreeController extends Controller
{
    function __construct()
    {
        // TITLE
        view()->share('title', 'Árbol de referidos');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // DO MENU
        view()->share('do', collect(['name' => 'inicio', 'text' => 'Inicio']));
        //
        return view('referraltree::index');
    }

    public function getReferreds()
    {
        $settings = Settings::first();
        $user = User::find(Auth::id());
        //
        $withs = '';

        for ($i=0; $i < $settings->referred_level_max ; $i++) { 
            if( $i === 0 ) {
                $withs .= 'children';
            }

            $withs .= '.children';
        } 

        $users = [];
        // Verificamos si tenemos permisos para ver todos.
        //if( $user->can('view all referrals') ) {

        //} else {
            $users[] = User::with($withs)->find( Auth::id() );
        //}

        //
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('referraltree::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('referraltree::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('referraltree::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
