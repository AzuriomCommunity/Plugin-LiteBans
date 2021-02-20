<?php

namespace Azuriom\Plugin\LiteBans\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display the LiteBans settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('litebans::admin.settings', [
            'host' => setting('litebans.host', '127.0.0.1'),
            'port' => setting('litebans.port', '3306'),
            'database' => setting('litebans.database', 'litebans'),
            'username' => setting('litebans.username'),
            'password' => setting('litebans.password'),
            'perpage' => setting('litebans.perpage'),
        ]);
    }

    public function save(Request $request)
    {
        $validated = $this->validate($request, [
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer', 'between:1,65535'],
            'database' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'perpage' => ['required', 'integer', 'between:1,100'],
        ]);

        Setting::updateSettings([
            'litebans.host' => $validated['host'],
            'litebans.port' => $validated['port'],
            'litebans.database' => $validated['database'],
            'litebans.username' => $validated['username'],
            'litebans.password' => $validated['password'],
            'litebans.perpage' => $validated['perpage'],
        ]);

        return redirect()->route('litebans.admin.settings')->with('success', trans('admin.settings.status.updated'));
    }
}
