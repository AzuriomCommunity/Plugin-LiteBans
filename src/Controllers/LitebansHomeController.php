<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Litebans\Models\Bans;
use Azuriom\Plugin\Litebans\Models\History;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class LitebansHomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (config()->get('database.connections.litebans') === NULL) {
                config()->set('database.connections.litebans', [
                    'driver'    => 'mysql',
                    'host'      => setting('litebans.host', '127.0.0.1'),
                    'port'      => setting('litebans.port', '3306'),
                    'database'  => setting('litebans.database', 'litebans'),
                    'username'  => setting('litebans.username'),
                    'password'  => setting('litebans.password'),
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                    'strict'    => false
                ]);
            }

            if (config()->get('litebans.perpage') === NULL) {
                config()->set('litebans.perpage', [
                    'perpage' => setting('litebans.perpage'),
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                    'strict'    => false
                ]);
            }

            $search = $request->input('search');

            $searchvalue = History::getUuid($search);

            $userhistory = History::when($searchvalue, function (Builder $query, string $search) {
                $query->scopes(['search' => $search]);
            })->get();

            return view('litebans::index', ['bansList' => Bans::getBansList(), 'search' => $search, 'userhistory' => $userhistory]);
        } catch (\PDOException $e) {
            return view('litebans::error');
        }

        return view('litebans::index');
    }
}
