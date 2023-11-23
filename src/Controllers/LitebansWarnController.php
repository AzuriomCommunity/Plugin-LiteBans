<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Plugin\Litebans\Models\Warning;

class LitebansWarnController extends LitebansController
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(setting('litebans.warns_enabled') == false, 404);
        return view('litebans::warn', ['warns' => Warning::getWarningsList()]);
    }
}
