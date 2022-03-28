<?php

namespace App\Service\Truck;

use App\Repository\Truck\TruckRepository;
use App\Singleton;
use Illuminate\Support\Facades\Log;

class TruckBusinessService extends Singleton
{
    private TruckRepository $truck_repository;

    public function __construct()
    {
        $this->truck_repository = TruckRepository::getInstance();
    }

    /**
     * Get all trucks
     *
     * @return array|null
     */
    public function Get(): array
    {
        return $this->truck_repository->GetAll()->transform(function ($truck) {
            return [
                'id'                => $truck->id,
                'plate_number'      => $truck->plate_number,
                'year_made'         => $truck->year_made,
                'weight_empty'      => $truck->contact,
                'type'              => $truck->type,
                'driver_id'         => $truck->id_driver ?? null,
                'driver_name'       => ($truck->driver != null) ? $truck->driver->name : 'Belum ada'
            ];
        })->toArray();
    }

    /**
     * Get truck's detail
     *
     * @param integer $truck_id
     * @return array|null
     */
    public function GetDetail(int $truck_id): ?array
    {
        $truck = $this->truck_repository->GetDetail($truck_id);
        if ($truck == null) return null;

        return [
            'id'                => $truck->id,
            'plate_number'      => $truck->plate_number,
            'year_made'         => $truck->year_made,
            'weight_empty'      => $truck->contact,
            'type'              => $truck->type,
            'driver_id'         => $truck->id_driver ?? null,
            'driver_name'       => ($truck->driver != null) ? $truck->driver->name : 'Belum ada'
        ];
    }

    /**
     * Register new truck
     *
     * @param string $plate_number
     * @param string $year_made
     * @param string $weight_empty
     * @param string $type
     * @param integer $id_vendor
     * @return boolean
     */
    public function Register(
        string $plate_number,
        string $year_made,
        string $weight_empty,
        string $type,
        int $id_vendor,
        int $id_driver = 0
    ): bool {
        // Save data
        // 0 for register a new one
        $ok = $this->truck_repository->Save(0, $plate_number, $year_made, $weight_empty, $type, $id_vendor, $id_driver);
        if (!$ok) return false;

        // Write log
        Log::info("Truck registered named " . $plate_number);

        return true;
    }

    /**
     * Update truck
     *
     * @param integer $id
     * @param string $plate_number
     * @param string $year_made
     * @param string $weight_empty
     * @param string $type
     * @param integer $id_vendor
     * @return boolean
     */
    public function Update(
        int $id,
        string $plate_number,
        string $year_made,
        string $weight_empty,
        string $type,
        int $id_vendor
    ): bool {
        // Save data
        $ok = $this->truck_repository->Save($id, $plate_number, $year_made, $weight_empty, $type, $id_vendor);
        if (!$ok) return false;

        // Write log
        Log::info("Truck updated named " . $plate_number);

        return true;
    }

    /**
     * Delete truck
     *
     * @param integer $id
     * @return boolean
     */
    public function Delete(int $id): bool
    {
        // Delete truck
        $deleted = $this->truck_repository->Delete($id);
        if (!$deleted) return false;

        // Write log
        Log::info("Truck deleted");
        return true;
    }
}
