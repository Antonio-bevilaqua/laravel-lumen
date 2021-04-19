<?php

namespace App\Models;


use App\Models\Serie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episodio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temporada',
        'numero',
        'assistido',
        'serie_id'
    ];

    protected $appends = ['links'];

    public function getAssistidoAttribute($assistido): bool
    {
        return $assistido;
    }

    public function getLinksAttribute($links): array
    {
        return [
            'self'  => "/api/episodios/".$this->id,
            'serie' => "/api/series/".$this->serie_id
        ];
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}