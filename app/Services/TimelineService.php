<?php

namespace App\Services;

use App\Mail\COLEmail;
use App\Models\Inscricao;
use App\Models\Timeline;
use Exception;
use Illuminate\Support\Facades\Mail;

class TimelineService
{

    public static function inscrito(Inscricao $inscricao)
    {
        try {
            Timeline::create([
                'inscricao_id' => $inscricao->id,
                'texto' => 'Inscrição Realizada'
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());            
        }
    }


}