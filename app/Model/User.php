<?php

namespace App\Model;

use App\Libraries\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, SearchTrait;

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
        'fullname', 'email', 'password', 'birthday', 'address', 'phone', 'image', 'is_admin'
    ];

    /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'users.address',
            'users.birthday',
            'users.fullname',
            'users.email',
            'users.phone'
        ]
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
     * This is a recommended way to declare event handlers
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if (Hash::needsRehash($user->password)) {
                $user->password = bcrypt($user->password);
            }
        });
    }

    /**
     * Value of admin
     */
    const ROLE_ADMIN = 1;

    /**
     * Value of user
     */
    const ROLE_USER = 0;

    /**
     * Value of pagination
     */
    const ROW_LIMIT = 10;
}
