<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $number
 * @property Collection $episodes
 * @property Serie $serie
 */
class Season extends Model
{
    use HasFactory;

    protected $fillable = ['number'];
    public $timestamps = false;

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getWatchedEpisodes(): Collection
    {
        return $this->episodes->filter(fn (Episode $episode) => $episode->watched);
    }
}
