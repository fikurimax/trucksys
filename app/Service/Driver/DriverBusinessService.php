<?php

namespace App\Service\Driver;

use App\Repository\Driver\DriverRepository;
use App\Singleton;
use Illuminate\Support\Facades\Log;

class DriverBusinessService extends Singleton
{
    private DriverRepository $driver_repository;

    public function __construct()
    {
        $this->driver_repository = DriverRepository::getInstance();
    }

    /**
     * Get all drivers
     *
     * @return array|null
     */
    public function Get(): array
    {
        return $this->driver_repository->GetAll()->transform(function ($driver) {
            return [
                'id'                    => $driver->id,
                'name'                  => $driver->name,
                'address'               => $driver->address,
                'contact'               => $driver->contact,
                'identity_number'       => $driver->identity_number,
                'driver_license_number' => $driver->driver_license_number,
                'truck'                 => ($driver->truck != null) ? $driver->truck->name : null
            ];
        })->toArray();
    }

    /**
     * Get driver's detail
     *
     * @param integer $driver_id
     * @return array|null
     */
    public function GetDetail(int $driver_id): ?array
    {
        $driver = $this->driver_repository->GetDetail($driver_id);
        if ($driver == null) return null;

        return [
            'id'                    => $driver->id,
            'name'                  => $driver->name,
            'address'               => $driver->address,
            'contact'               => $driver->contact,
            'identity_number'       => $driver->identity_number,
            'driver_license_number' => $driver->driver_license_number
        ];
    }

    /**
     * Find driver by search key
     *
     * @param string $searchQuery
     * @return array|null
     */
    public function Find(string $searchQuery): ?array
    {
        $drivers = $this->driver_repository->Find($searchQuery);
        if ($drivers->empty()) {
            return null;
        }

        return $drivers->transform(function ($driver) {
            return [
                'id'    => $driver->id,
                'text'  => $driver->name
            ];
        })->toArray();
    }

    /**
     * Register new driver
     *
     * @param string $name
     * @param string $address
     * @param string $contact
     * @param integer $identity_number
     * @param integer $driver_license_number
     * @return bool
     */
    public function Register(
        string $name,
        string $address,
        string $contact,
        int $identity_number,
        int $driver_license_number
    ): bool {
        // Save data
        // 0 for register a new one
        $ok = $this->driver_repository->Save(0, $name, $address, $contact, $identity_number, $driver_license_number);
        if (!$ok) return false;

        // Write log
        Log::info("Driver registered named " . $name);

        return true;
    }

    /**
     * Update driver
     *
     * @param integer $id
     * @param string $name
     * @param string $address
     * @param string $contact
     * @param integer $identity_number
     * @param integer $driver_license_number
     * @return boolean
     */
    public function Update(
        int $id,
        string $name,
        string $address,
        string $contact,
        int $identity_number,
        int $driver_license_number
    ): bool {
        // Save data
        $ok = $this->driver_repository->Save($id, $name, $address, $contact, $identity_number, $driver_license_number);
        if (!$ok) return false;

        // Write log
        Log::info("Driver updated named " . $name);

        return true;
    }

    /**
     * Delete driver
     *
     * @param integer $id
     * @return boolean
     */
    public function Delete(int $id): bool
    {
        // Delete driver
        $deleted = $this->driver_repository->Delete($id);
        if (!$deleted) return false;

        // Write log
        Log::info("Driver deleted");
        return true;
    }
}
