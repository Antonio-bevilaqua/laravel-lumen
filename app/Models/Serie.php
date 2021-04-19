<?php

namespace App\Models;


use App\Models\Episodio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    protected $appends = ['links'];

    protected $perPage = 3;

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function getLinksAttribute($links): array
    {
        return [
            'episodios' => "/api/series/".$this->id."/episodios"
        ];
    }
}
