<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Cinema extends Model
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
    protected $table = 'cinemas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name', 'city_id'
    ];

     /**
     * Relationship hasMany with room
     *
     * @return array
    */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_id');
    }

    /**
     * Relationship with city
     *
     * @return \App\Model
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
