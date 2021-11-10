<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Collection $seasons
 */
class Serie extends Model
{
    protected $table = 'series';

    protected $fillable = ['name'];
    public $timestamps = false;

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}
