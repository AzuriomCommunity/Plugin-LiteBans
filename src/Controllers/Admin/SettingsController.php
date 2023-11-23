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
            'prefix' => setting('litebans.prefix', 'litebans_'),
            'mutes_enabled' => setting('litebans.mutes_enabled', true),
            'kicks_enabled' => setting('litebans.kicks_enabled', true),
            'warns_enabled' => setting('litebans.warns_enabled', true),
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
            'prefix' => ['required', 'string', 'max:255'],
            'mutes_enabled' => ['nullable'],
            'kicks_enabled' => ['nullable'],
            'warns_enabled' => ['nullable'],
        ]);

        Setting::updateSettings([
            'litebans.host' => $validated['host'],
            'litebans.port' => $validated['port'],
            'litebans.database' => $validated['database'],
            'litebans.username' => $validated['username'],
            'litebans.password' => $validated['password'],
            'litebans.prefix' => $validated['prefix'] ?? 'litebans_',
            'litebans.perpage' => $validated['perpage'],
            'litebans.mutes_enabled' => $request->has('mutes_enabled'),
            'litebans.kicks_enabled' => $request->has('kicks_enabled'),
            'litebans.warns_enabled' => $request->has('warns_enabled'),
        ]);

        return redirect()->route('litebans.admin.settings')->with('success', trans(trans('admin.settings.updated')));
    }
}
