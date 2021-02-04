<?php

namespace Azuriom\Plugin\Litebans\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Azuriom\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Exception;

class History extends Model
{
  use HasTablePrefix;
  use Searchable;

  /**
   * The table prefix associated with the model.
   *
   * @var string
   */
  protected $prefix = 'litebans_';

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'litebans_history';

  protected $connection = 'litebans';

  /**
   * The attributes that can be search for.
   *
   * @var array
   */
  protected $searchable = [
    'name', 'uuid',
  ];

  public static function getUserHistory()
  {

    $uuid = request()->input('uuid');

    $result = [
      'bans' => Bans::where('uuid', $uuid)->paginate(
        setting('litebans.perpage')
      ),
      'mutes' => Mutes::where('uuid', $uuid)->paginate(
        setting('litebans.perpage')
      ),
      'kicks' => Kicks::where('uuid', $uuid)->paginate(
        setting('litebans.perpage')
      ),
      'warnings' => Warnings::where('uuid', $uuid)->paginate(setting('litebans.perpage'))
    ];

    return $result;
  }

  public static function getStaffHistory()
  {

    $uuid = request()->input('uuid');

    $result = [
      'bans' => Bans::where('banned_by_uuid', $uuid)->paginate(
        setting('litebans.perpage')
      ),
      'mutes' => Mutes::where('banned_by_uuid', $uuid)->paginate(
        setting('litebans.perpage')
      ),
      'kicks' => Kicks::where('banned_by_uuid', $uuid)->paginate(
        setting('litebans.perpage')
      ),
      'warnings' => Warnings::where('banned_by_uuid', $uuid)->paginate(
        setting('litebans.perpage')
      )
    ];

    return $result;
  }

  public static function getHistoryList()
  {
    return self::select('*')
      ->where('uuid', '=', $_GET['uuid'])
      ->get();
  }

  public static function getName($uuid)
  {
    if ($uuid === null || $uuid === "" || $uuid[0] === '#') return null;

    return self::select('name')
      ->where('uuid', '=', $uuid)
      ->first()
      ->name;
  }

  public static function getUuid($uuid)
  {
    if ($uuid === null || $uuid === "" || $uuid[0] === '#') return null;

    return self::select('uuid')
      ->where('name', '=', $uuid)
      ->first()
      ->uuid;
  }
}
