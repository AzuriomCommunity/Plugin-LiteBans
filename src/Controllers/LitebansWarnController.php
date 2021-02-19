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
        return view('litebans::warn', ['warns' => Warning::getWarningsList()]);
    }
}
