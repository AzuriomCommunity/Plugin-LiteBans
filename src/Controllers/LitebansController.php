<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Litebans\Models\Ban;
use Azuriom\Plugin\Litebans\Models\Kick;
use Azuriom\Plugin\Litebans\Models\Mute;
use Azuriom\Plugin\Litebans\Models\Warning;
use Azuriom\Plugin\Litebans\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class LitebansController extends Controller
{
    public function __construct()
    {
        if (config()->get('database.connections.litebans') === null) {
            abort_if(setting('litebans.host') === null, 404);

            config()->set('database.connections.litebans', [
                'driver' => 'mysql',
                'host' => setting('litebans.host', '127.0.0.1'),
                'port' => setting('litebans.port', '3306'),
                'database' => setting('litebans.database', 'litebans'),
                'username' => setting('litebans.username'),
                'password' => setting('litebans.password'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false
            ]);
        }

        View::share([
            'bansCount' => Ban::count(),
            'mutesCount' => Mute::count(),
            'warnsCount' => Warning::count(),
            'kicksCount' => Kick::count(),
        ]);
    }


    public function search(Request $request)
    {
        $key = $request->input('q');

        if ($key) {
            return redirect()->route('litebans.history', $key);
        }
        return back()->with('error', "Cet utilisateur n'existe pas !");

        /*$search = History::select('uuid')
            ->where('name', 'like', "%{$key}%")
            ->get();*/
    }

    public function profile()
    {
        return redirect()->route('litebans.history', Auth::user()->name);
    }
}
