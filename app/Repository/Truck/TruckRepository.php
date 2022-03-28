<?php

namespace App\Repository\Truck;

use App\Models\Truck as Model;
use App\Singleton;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class TruckRepository extends Singleton
{
    /**
     * Get all models data
     *
     * @return Collection
     */
    public function GetAll(): Collection
    {
        return Model::get();
    }

    /**
     * Get model detail
     *
     * @param integer $truck_id
     * @return Model
     */
    public function GetDetail(int $truck_id): Model
    {
        return Model::find($truck_id);
    }

    /**
     * Save model data
     *
     * @param integer $id
     * @param string $plate_number
     * @param integer $year_made
     * @param string $weight_empty
     * @param string $type
     * @param integer $vendor_id
     * @param integer|null $driver_id
     * @return boolean
     */
    public function Save(
        int $id,
        string $plate_number,
        int $year_made,
        string $weight_empty,
        string $type,
        int $vendor_id,
        int $driver_id = null
    ): bool {
        try {
            if ($id == 0) {
                $truck = new Model();
            } else {
                $truck = Model::find($id);
            }
            $truck->plate_number   = $plate_number;
            $truck->year_made      = $year_made;
            $truck->weight_empty   = $weight_empty;
            $truck->type           = $type;
            $truck->id_vendor      = $vendor_id;
            if ($driver_id != null) {
                $truck->id_driver  = $driver_id;
            }
            $truck->save();

            return true;
        } catch (\Throwable $th) {
            Log::critical($th->getMessage());

            return false;
        }
    }

    /**
     * Delete model
     *
     * @param integer $id
     * @return boolean
     */
    public function Delete(int $id): bool
    {
        try {
            Model::find($id)->delete();

            return true;
        } catch (\Throwable $th) {
            Log::critical($th->getMessage());

            return false;
        }
    }
}
