<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'city'
    ];

     /**
     * Relationship hasMany with cinema
     *
     * @return array
    */
    public function cinemas()
    {
        return $this->hasMany(Cinema::class, 'city_id');
    }
}
