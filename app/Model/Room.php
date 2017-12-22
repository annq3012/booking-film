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
     * Get type of a room.
     *
     * @return string
     */
    public function getTypeLabelAttribute()
    {
        switch ($this->attributes['type']) {
            case 1:
                return  __('2D');
                break;
            case 2:
                return  __('3D');
                break;
            case 3:
                return __('4D');
                break;
            default:
                return __('5D');
                break;
        }
    }
}
