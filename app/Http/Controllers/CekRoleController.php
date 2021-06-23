<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekRoleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->hasRole(['admin', 'petugas'])) {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }
}
