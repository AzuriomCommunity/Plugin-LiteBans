<?php

namespace Azuriom\Plugin\Litebans\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Litebans\Models\Warnings;

class LitebansWarnController extends Controller
{
 /**
  * Show the home plugin page.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
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

   return view('litebans::warn', ['warnsList' => Warnings::getWarningsList()]);
  } catch (\PDOException $e) {
   return view('litebans::error');
  }

  return view('litebans::warn');
 }
}
