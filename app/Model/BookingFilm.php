<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookingFilm extends Model
{
     /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'booking_films';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'booking_time', 'user_id', 'schedule_id', 'status'
    ];

     /**
     * Relationship with user
     *
     * @return \App\Model
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship hasMany with detail booking
     *
     * @return array
    */
    public function detailBooking()
    {
        return $this->hasMany(DetailBooking::class, 'booking_film_id');
    }

     /**
     * Relationship with schedule
     *
     * @return \App\Model
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
