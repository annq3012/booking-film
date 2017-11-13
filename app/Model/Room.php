<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Room extends Model
{
    use Sluggable;

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
}
