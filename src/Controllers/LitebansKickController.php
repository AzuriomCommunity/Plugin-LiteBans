<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Plugin\Litebans\Models\Kick;

class LitebansKickController extends LitebansController
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(setting('litebans.kicks_enabled', true) == false, 404);
        return view('litebans::kick', ['kicks' => Kick::getKicksList()]);
    }
}
