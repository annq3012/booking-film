<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

     /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'birthday', 'address', 'image', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relationship hasMany with bookingFilm
     *
     * @return array
    */
    public function bookingFilm()
    {
        return $this->hasMany(BookingFilm::class);
    }

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;

    /**
     * Value of admin
     */
    const ROLE_ADMIN = 1;

    /**
     * Value of user
     */
    const ROLE_USER = 0;
}
