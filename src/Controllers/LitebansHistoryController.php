<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Plugin\Litebans\Models\History;

class LitebansHistoryController extends LitebansController
{
    /**
     * Show the home plugin page.
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function index(string $name)
    {
        $uuid = History::where('name', $name)->value('uuid');

        if ($uuid === null) {
            return back()->with('error-search', "Cet utilisateur n'existe pas");
        }

        $user = [
            'name' => $name,
            'uuid' => $uuid,
            'issued' => false,
        ];

        return view('litebans::history', array_merge(History::getUserHistory($uuid), $user));
    }

    public function issued(string $name)
    {
        $uuid = History::where('name', $name)->value('uuid');

        if ($uuid === null) {
            return back()->with('error-search', "Cet utilisateur n'existe pas");
        }

        $user = [
            'name' => $name,
            'uuid' => $uuid,
            'issued' => true,
        ];

        return view('litebans::history', array_merge(History::getStaffHistory($uuid), $user));
    }
}
