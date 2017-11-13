<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
     /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'seats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'x_axist', 'y_axist', 'type', 'room_id'
    ];

    /**
     * Relationship with room
     *
     * @return \App\Model
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
