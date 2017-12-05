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
        'name', 'description', 'language', 'derector', 'actor', 'year', 'duration', 'image', 'rated', 'release', 'genre', 'link', 'technologies', 'status'
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
     * Value of actived user
     */
    const STATUS_ACTIVED = 1;

    /**
     * Value of disabled user
     */
    const STATUS_DISABLED = 0;

    /**
     * Value of type 2D
     */
    const TYPE_2D = '2D';

    /**
     * Value of type 3D
     */
    const TYPE_3D = '3D';

    /**
     * Value of type 4D
     */
    const TYPE_4D = '4D';

    /**
     * Value of type 5D
     */
    const TYPE_5D = '5D';

    /**
     * Type of rooms statuses
     *
     * @type array
     */
    public static $availableTechnologies = [
        '2D' => self::TYPE_2D,
        '3D' => self::TYPE_3D,
        '4D' => self::TYPE_4D,
        '5D' => self::TYPE_5D
    ];

    /**
     * Value of RATED 2D
     */
    const RATED_13 = '13+';

    /**
     * Value of RATED 3D
     */
    const RATED_16 = '16+';

    /**
     * Value of RATED 4D
     */
    const RATED_18 = '18+';

    /**
     * Type of rooms statuses
     *
     * @type array
     */
    public static $availableRated = [
        '13+' => self::RATED_13,
        '16+' => self::RATED_16,
        '18+' => self::RATED_18,
    ];
}
