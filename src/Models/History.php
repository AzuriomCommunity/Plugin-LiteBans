<?php

namespace Azuriom\Plugin\Litebans\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Azuriom\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use Searchable;

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

    public function __construct()
    {
        parent::__construct();
        $this->prefix = setting('litebans.prefix', 'litebans_');
    }

    public function getTable(): string
    {
        if ($this->table === null) {
            $this->setTable($this->prefix . "history");
        }

        return $this->table;
    }

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
