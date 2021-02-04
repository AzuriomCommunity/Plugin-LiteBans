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
  Setting::updateSettings('litebans.host', $this->validate($request, [
   'host' => ['required', 'string', 'max:255'],
  ])['host']);
  Setting::updateSettings('litebans.port', $this->validate($request, [
   'port' => ['required', 'integer', 'between:1,65535'],
  ])['port']);
  Setting::updateSettings('litebans.database', $this->validate($request, [
   'database' => ['required', 'string', 'max:255'],
  ])['database']);
  Setting::updateSettings('litebans.username', $this->validate($request, [
   'username' => ['required', 'string', 'max:255'],
  ])['username']);
  Setting::updateSettings('litebans.password', $this->validate($request, [
   'password' => ['required', 'string', 'max:255'],
  ])['password']);
  Setting::updateSettings('litebans.perpage', $this->validate($request, [
   'perpage' => ['required', 'integer', 'between:1,65535'],
  ])['perpage']);

  return redirect()->route('litebans.admin.settings')->with('success', trans('admin.settings.status.updated'));
 }
}
