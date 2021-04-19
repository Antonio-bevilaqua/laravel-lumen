<?php

namespace App\Services;

use App\Models\Episodio;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;
use Throwable;

class RemovedorDeSeries
{
    public static function removerSerie(int $id_serie): bool
    {
        $serie = Serie::find($id_serie);

        if (!$serie) return false;

        $retorno = true;

        DB::beginTransaction();
        try {
            self::removerEpisodios($serie);
            
            $serie->delete();

            DB::commit();

        } catch(Throwable $e){

            DB::rollBack();
            $retorno = false;
        }
        return $retorno;
    }

    private static function removerEpisodios(Serie &$serie): void
    {
        $serie->episodios->each(function (Episodio $episodio){
            $episodio->delete();
        });
    }
}
