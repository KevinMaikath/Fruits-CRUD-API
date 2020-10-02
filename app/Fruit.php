<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $table = 'fruits';

    protected $fillable = [
        'name',
        'size',
        'colour'
    ];

    public const SIZES = [
        'S' => 'SMALL',
        'M' => 'MEDIUM',
        'L' => 'LARGE'
    ];

    /**
     * Return the letter corresponding to the size
     *
     * @param $size
     * @return false|int|string
     */
    public static function getSizeLetter($size)
    {
        return array_search($size, self::SIZES);
    }

    /**
     * Get fruit size (from letter to name)
     *
     * @return string
     */
    public function getSizeAttribute()
    {
        return self::SIZES[$this->attributes['size']];
    }

    /**
     * Set fruit size (from name to letter)
     *
     * @param $value
     */
    public function setSizeAttribute($value)
    {
        $size = self::getSizeLetter($value);

        if ($size) {
            $this->attributes['size'] = $size;
        }
    }
}
