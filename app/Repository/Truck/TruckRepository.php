<?php

namespace App\Repository\Truck;

use App\Models\Truck as Model;
use Illuminate\Support\Facades\Log;

class TruckRepository
{
    public function GetAll()
    {
        return Model::get();
    }

    public function Create(Model $model)
    {
        try {
            $model->save();
        } catch (\Throwable $th) {
            Log::fatal($th->getMessage());
        }
    }
}
