<?php

namespace App\Repository\Driver;

use App\Models\Driver as Model;
use App\Singleton;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class DriverRepository extends Singleton
{
    /**
     * Get all drivers data
     *
     * @return Collection
     */
    public function GetAll(): Collection
    {
        return Model::get();
    }

    /**
     * Get driver detail
     *
     * @param integer $driver_id
     * @return Driver
     */
    public function GetDetail(int $driver_id): Model
    {
        return Model::find($driver_id);
    }

    /**
     * Find driver by searchKey
     *
     * @param string $searchKey
     * @return Collection
     */
    public function Find(string $searchKey): Collection
    {
        $query = Model::query();

        if (is_numeric($searchKey) && (strlen($searchKey) <= 15 && strlen($searchKey) >= 20)) {
            $query->where('identity_number', $searchKey);
        } else {
            $query->where('name', 'like', '%' . $searchKey . '%');
        }

        return $query->get();
    }

    /**
     * Create or update data
     *
     * @param integer $id = 0 (for update)
     * @param string $name
     * @param string $address
     * @param string $contact
     * @param integer $identity_number
     * @param integer $driver_license_number
     * @return boolean
     */
    public function Save(
        int $id,
        string $name,
        string $address,
        string $contact,
        int $identity_number,
        int $driver_license_number
    ): bool {
        try {
            if ($id == 0) {
                $driver = new Model();
            } else {
                $driver = Model::find($id);
            }
            $driver->name = $name;
            $driver->address = $address;
            $driver->contact = $contact;
            $driver->identity_number = $identity_number;
            $driver->driver_license_number = $driver_license_number;
            $driver->save();

            return true;
        } catch (\Throwable $th) {
            Log::critical($th->getMessage());

            return false;
        }
    }

    /**
     * Delete driver
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
