<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use Sluggable, SoftDeletes;

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
    protected $table = 'films';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name', 'description', 'language', 'director', 'actor', 'year', 'duration', 'image', 'rated', 'release', 'genre', 'link', 'technologies', 'status'
    ];

    /**
     * Relationship with rooms
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rooms()
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
        return $this->hasMany(Schedule::class, 'fiml_id');
    }

    /**
     * Value of pagination
     */
    const ROW_LIMIT = 10;

    /**
     * Type of rooms statuses
     *
     * @type array
     */
    public static $rated = [
        '13+', '16+', '18+',
    ];

    /**
     * Get status of a reservation.
     *
     * @return string
     */
    public function getTypeLabelAttribute()
    {
        switch ($this->attributes['technologies']) {
            case '2D':
                return  __('2D');
                break;
            case '3D':
                return  __('3D');
                break;
            case '4D':
                return __('4D');
                break;
            default:
                return __('5D');
                break;
        }
    }

    /**
     * Get parameter of a film.
     *
     * @return array
     */
    public static function getParameter()
    {
        $arrPara = array('rated' => Film::$rated,
        'actived' => 1,
        'disabled' => 0);
        return $arrPara;
    }
}
