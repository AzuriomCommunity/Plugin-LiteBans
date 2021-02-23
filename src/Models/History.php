<?php

namespace Azuriom\Plugin\Litebans\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Azuriom\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

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

    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * The attributes that can be search for.
     *
     * @var array
     */
    protected $searchable = [
        'name',
    ];

    public static function getUserHistory(string $uuid)
    {
        return [
            'bans' => Ban::where('uuid', $uuid)->paginate(
                setting('litebans.perpage')
            ),
            'mutes' => Mute::where('uuid', $uuid)->paginate(
                setting('litebans.perpage')
            ),
            'kicks' => Kick::where('uuid', $uuid)->paginate(
                setting('litebans.perpage')
            ),
            'warnings' => Warning::where('uuid', $uuid)->paginate(setting('litebans.perpage'))
        ];
    }

    public static function getStaffHistory(string $uuid)
    {
        return [
            'bans' => Ban::where('banned_by_uuid', $uuid)->paginate(
                setting('litebans.perpage')
            ),
            'mutes' => Mute::where('banned_by_uuid', $uuid)->paginate(
                setting('litebans.perpage')
            ),
            'kicks' => Kick::where('banned_by_uuid', $uuid)->paginate(
                setting('litebans.perpage')
            ),
            'warnings' => Warning::where('banned_by_uuid', $uuid)->paginate(
                setting('litebans.perpage')
            )
        ];
    }
}
