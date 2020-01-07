<?php

namespace App\Traits;

trait FormatsDate
{
    public static function boot()
    {
        parent::boot();
        static::retrieved(function ($model) {
            self::formatDates($model);
        });
        static::saved(function ($model) {
            self::formatDates($model);
        });
    }

    private static function formatDates($model)
    {
        foreach ($model->getDates() as $dateField){
            if(!is_null($model->{$dateField})){
                $model->{$dateField} = $model->{$dateField}->timezone(optional(auth()->user())->messenger->timezone ?? 'America/New_York');
            }
        }
    }
}
