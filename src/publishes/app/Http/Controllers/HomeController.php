<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{

    /**
     * Exibe a página inicial do sistema.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

}
