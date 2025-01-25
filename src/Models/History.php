<?php

namespace Azuriom\Plugin\Litebans\Models;

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

    public static function getUserHistory(string $uuid) {
        return History::getSpecificHistory("uuid", $uuid);
    }

    public static function getStaffHistory(string $uuid) {
        return History::getSpecificHistory("banned_by_uuid", $uuid);
    }

    private static function getSpecificHistory(string $key, string $uuid) {
        $perPage = setting('litebans.perpage');
        return [
            "bans" => Ban::where($key, $uuid)->paginate($perPage),
            "bans_count" => Ban::where($key, $uuid)->count(),
            "kicks" => Kick::where($key, $uuid)->paginate($perPage),
            "kicks_count" => Kick::where($key, $uuid)->count(),
            "mutes" => Mute::where($key, $uuid)->paginate($perPage),
            "mutes_count" => Mute::where($key, $uuid)->count(),
            "warnings" => Warning::where($key, $uuid)->paginate($perPage),
            "warnings_count" => Warning::where($key, $uuid)->count()
        ];
    }
}
