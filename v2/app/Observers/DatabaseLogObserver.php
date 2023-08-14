<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class DatabaseLogObserver
{
    /**
     * Handle the Model "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function created(Model $model)
    {
        Log::channel('custom_db_log')->info('Registro criado: ' . $model);
    }

    /**
     * Handle the Model "updated" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function updated(Model $model)
    {
        Log::channel('custom_db_log')->info('Registro atualizado: ' . $model);
    }

    /**
     * Handle the Model "deleted" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function deleted(Model $model)
    {
        Log::channel('custom_db_log')->info('Registro excluído: ' . $model);
    }
}
