<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Plugin\Litebans\Models\Ban;
use Illuminate\Http\Request;

class LitebansHomeController extends LitebansController
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$search = $request->input('search');

        $searchvalue = History::getUuid($search);

        $userhistory = History::when($searchvalue, function (Builder $query, string $search) {
            $query->scopes(['search' => $search]);
        })->get();*/

        return view('litebans::index', [
            'bans' => Ban::getBansList(),
            //'search' => $search,
            //'userhistory' => $userhistory,
        ]);
    }
}
