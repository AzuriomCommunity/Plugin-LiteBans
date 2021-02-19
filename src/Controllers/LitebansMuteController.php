<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Plugin\Litebans\Models\Mute;

class LitebansMuteController extends LitebansController
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('litebans::mute', ['mutes' => Mute::getMutesList()]);
    }
}
