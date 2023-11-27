<?php

namespace App\Traits;
use Carbon\Carbon;

/**
 * Trait para formatação dos atributos created_at e updated_at
 */

trait CreatedUpdated
{
    /**
     * Retorna o atributo created_at com a data no formato d/m/Y - H:i:s
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->setTimezone(config('app.timezone'))
            ->format('d/m/Y - H:i:s');
    }

    /**
     * Retorna o atributo updated_at com a data no formato d/m/Y - H:i:s
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->setTimezone(config('app.timezone'))
            ->format('d/m/Y - H:i:s');
    }
}
