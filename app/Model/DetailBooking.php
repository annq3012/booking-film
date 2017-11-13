<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
     /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'detail_booking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'x_axist', 'y_axist', 'price', 'booking_film_id'
    ];

    /**
     * Relationship with booking film
     *
     * @return \App\Model
     */
    public function bookingFilm()
    {
        return $this->belongsTo(BookingFilm::class, 'booking_film_id');
    }
}
