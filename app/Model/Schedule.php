<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'schedules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'start_time', 'end_time', 'date', 'film_id', 'room_id', 'available_seats'
    ];

    /**
     * Relationship with film
     *
     * @return \App\Model
     */
    public function films()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    /**
     * Relationship with room
     *
     * @return \App\Model
     */
    public function rooms()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Relationship hasMany with booking film
     *
     * @return array
    */
    public function bookingFilm()
    {
        return $this->hasMany(BookingFilm::class);
    }
}
