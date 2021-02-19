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
    public function index(string $uuid)
    {
        $name = History::where('uuid', $uuid)->value('name');

        abort_if($name === null, 404);

        $user = [
            'name' => $name,
            'uuid' => $uuid,
            'issued' => false,
        ];

        return view('litebans::history', array_merge(History::getUserHistory($uuid), $user));
    }

    public function issued(string $uuid)
    {
        $name = History::where('uuid', $uuid)->value('name');

        abort_if($name === null, 404);

        $user = [
            'name' => $name,
            'uuid' => $uuid,
            'issued' => true,
        ];

        return view('litebans::history', array_merge(History::getStaffHistory($uuid), $user));
    }
}
