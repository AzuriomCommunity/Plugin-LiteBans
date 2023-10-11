<?php

namespace Azuriom\Plugin\Litebans\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Azuriom\Plugin\Litebans\Casts\DateCast;
use Illuminate\Database\Eloquent\Model;

class Kick extends Model
{
    use HasTablePrefix;

    /**
     * The table prefix associated with the model.
     *
     * @var string
     */
    protected $prefix = 'litebans_';

    protected $connection = 'litebans';

    protected $casts = [
        'time' => DateCast::class,
        'until' => DateCast::class,
        'silent' => 'boolean',
        'ipban' => 'boolean',
        'ipban_wildcard' => 'boolean',
        'active' => 'boolean',
    ];

    protected $with = [
        'history',
    ];

    public function getNameAttribute()
    {
        return $this->history->name ?? "?";
    }

    public function history()
    {
        return $this->belongsTo(History::class, 'uuid', 'uuid');
    }

    public static function getKicksList()
    {
        return self::orderByDesc('id')->paginate(setting('litebans.perpage'));
    }
}
