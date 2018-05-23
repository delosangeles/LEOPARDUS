<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mostramos el home de la aplicación.
     *
     * @return view()
     */
    public function index()
    {
        return view('welcome');
    }
}
