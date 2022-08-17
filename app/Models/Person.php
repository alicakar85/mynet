<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'birthday', 'gender'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'birthday' => 'date',
    ];

    const GENDERS_LABEL = [
      1 => 'Kadın',
      2 => 'Erkek',
    ];

    /**
     * @param int|null $gender
     * @return array|string
     */
    public static function genders($gender = '')
    {
        return (isset(self::GENDERS_LABEL[$gender])) ? self::GENDERS_LABEL[$gender] : self::GENDERS_LABEL;
    }

    /**
     * @return HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
