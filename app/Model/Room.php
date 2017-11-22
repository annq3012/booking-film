<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes, Sluggable;

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
        return $this->hasMany(Seat::class);
    }

    /**
     * Value of pagination
     */
    const ROW_LIMIT = 10;


    /**
     * Value of type 2D
     */
    const TYPE_2D = 1 ;

    /**
     * Value of type 3D
     */
    const TYPE_3D = 2 ;

    /**
     * Value of type 4D
     */
    const TYPE_4D = 3 ;

    /**
     * Value of type 5D
     */
    const TYPE_5D = 4 ;

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
