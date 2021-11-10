<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $number
 * @property bool $watched
 * @property Season $season
 */
class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['number'];
    public $timestamps = false;

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
