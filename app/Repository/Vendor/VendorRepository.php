<?php

namespace App\Repository\Vendor;

use App\Models\TruckVendor as Model;
use App\Singleton;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class VendorRepository extends Singleton
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
     * Get driver detail
     *
     * @param integer $vendor_id
     * @return Model
     */
    public function GetDetail(int $vendor_id): Model
    {
        return Model::find($vendor_id);
    }

    /**
     * Create or update data
     *
     * @param integer $id = 0 (for create new)
     * @param string $name
     * @param string $address
     * @param string $contact
     * @param string $tin
     * @return boolean
     */
    public function Save(
        int $id,
        string $name,
        string $address,
        string $contact,
        string $tin
    ): bool {
        try {
            if ($id == 0) {
                $vendor = new Model();
            } else {
                $vendor = Model::find($id);
            }
            $vendor->name = $name;
            $vendor->address = $address;
            $vendor->contact = $contact;
            $vendor->tin = $tin;
            $vendor->save();

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
