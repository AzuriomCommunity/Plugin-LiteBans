<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Plugin\Litebans\Models\History;
use Illuminate\Http\Request;

class LitebansHistoryController extends LitebansController
{
    /**
     * Show the home plugin page.
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, string $name)
    {
        $uuid = History::where('name', $name)->value('uuid');

        if ($uuid === null) {
            return $this->searchNotFound($name);
        }
        
        $selected = "bans"; // default selected
        foreach($request->input() as $key => $val) {
            $key = strtolower($key);
            if(in_array($key, [ "bans", "mutes", "kicks", "warns" ])) {
                $selected = $key;
            }
        }
        $user = [
            'name' => $name,
            'uuid' => $uuid,
            'issued' => false,
            'selected' => $selected
        ];

        return view('litebans::history', array_merge(History::getUserHistory($uuid), $user));
    }

    public function issued(Request $request, string $name)
    {
        $uuid = History::where('name', $name)->value('uuid');

        if ($uuid === null) {
            return $this->searchNotFound($name);
        }
        $selected = "bans"; // default selected
        foreach($request->input() as $key => $val) {
            $key = strtolower($key);
            if(in_array($key, [ "bans", "mutes", "kicks", "warns" ])) {
                $selected = $key;
            }
        }
        $user = [
            'name' => $name,
            'uuid' => $uuid,
            'issued' => true,
            'selected' => $selected
        ];

        return view('litebans::history', array_merge(History::getStaffHistory($uuid), $user));
    }

    public function searchNotFound(string $name) {
        $history = History::where('name', 'like', "%$name%")->paginate(setting('litebans.perpage'));
        if(empty($history))
            return back()->with('error', "Cet utilisateur n'existe pas");
        return view('litebans::search', [ "history" => $history ]);
    }
}
