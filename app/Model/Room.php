<?php

namespace App\Model;

use App\Libraries\Traits\SearchTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes, Sluggable, SearchTrait;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name', 'type', 'max_seats', 'cinema_id'
    ];

    /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'rooms.id',
            'rooms.name',
            'rooms.cinema_id',
            'rooms.type',
            'rooms.max_seats',
         ]
    ];

    /**
     * Relationship with films
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function films()
    {
        return $this->belongsToMany(App\Model\Room::class, 'schedules');
    }

    /**
     * Relationship hasMany with schedules
     *
     * @return array
    */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'room_id');
    }

    /**
     * Relationship with cinema
     *
     * @return \App\Model
     */
    public function cinema()
    {
        return $this->belongsTo(Cinema::class, 'cinema_id');
    }

    /**
     * Relationship hasMany with seat
     *
     * @return array
    */
    public function seats()
    {
        return $this->hasMany(Seat::class, 'room_id');
    }

     /**
     * Return the room configuration array for this model.
     *
     * @return array
    */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($room) {
            $room->seats()->delete();
        });
    }

    /**
     * Value of pagination
     */
    const ROW_LIMIT = 10;

    /**
     * Value of type 2D
     */
    const TYPE_2D = 1;

    /**
     * Value of type 3D
     */
    const TYPE_3D = 2;

    /**
     * Value of type 4D
     */
    const TYPE_4D = 3;

    /**
     * Value of type 5D
     */
    const TYPE_5D = 4;

    /**
     * Type of rooms statuses
     *
     * @type array
     */
    public static $availableStatuses = [
        '2D' => self::TYPE_2D,
        '3D' => self::TYPE_3D,
        '4D' => self::TYPE_4D,
        '5D' => self::TYPE_5D
    ];


    /**
     * Get type of a room.
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->attributes['type']) {
            case self::TYPE_3D:
                return __('3D');
                break;
            case self::TYPE_4D:
                return __('4D');
                break;
            case self::TYPE_5D:
                return __('5D');
                break;
            default:
                return __('2D');
                break;
        }
    }

    /**
     * Get status of a reservation.
     *
     * @return string
     */
    public function getTypeLabelAttribute()
    {
        switch ($this->attributes['type']) {
            case self::TYPE_2D:
                return  __('2D');
                break;
            case self::TYPE_3D:
                return  __('3D');
                break;
            case self::TYPE_4D:
                return __('4D');
                break;
            default:
                return __('5D');
                break;
        }
    }
}
