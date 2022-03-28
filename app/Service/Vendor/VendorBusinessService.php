<?php

namespace App\Service\Vendor;

use App\Repository\Vendor\VendorRepository;
use App\Singleton;
use Illuminate\Support\Facades\Log;

class VendorBusinessService extends Singleton
{
    private VendorRepository $vendor_repository;

    public function __construct()
    {
        $this->vendor_repository = VendorRepository::getInstance();
    }

    /**
     * Get all vendors
     *
     * @return array|null
     */
    public function Get(): array
    {
        return $this->vendor_repository->GetAll()->transform(function ($vendor) {
            return [
                'id'        => $vendor->id,
                'name'      => $vendor->name,
                'address'   => $vendor->address,
                'contact'   => $vendor->contact,
                'tin'       => $vendor->tin,
                'truck_counts' => $vendor->trucks->count()
            ];
        })->toArray();
    }

    /**
     * Get vendor's detail
     *
     * @param integer $vendor_id
     * @return array|null
     */
    public function GetDetail(int $vendor_id): ?array
    {
        $vendor = $this->vendor_repository->GetDetail($vendor_id);
        if ($vendor == null) return null;

        return [
            'id'       => $vendor->id,
            'name'     => $vendor->name,
            'address'  => $vendor->address,
            'contact'  => $vendor->contact,
            'tin'      => $vendor->tin
        ];
    }

    /**
     * Register new vendor
     *
     * @param string $name
     * @param string $address
     * @param string $contact
     * @param string $tin
     * @return bool
     */
    public function Register(
        string $name,
        string $address,
        string $contact,
        string $tin
    ): bool {
        // Save data
        // 0 for register a new one
        $ok = $this->vendor_repository->Save(0, $name, $address, $contact, $tin);
        if (!$ok) return false;

        // Write log
        Log::info("Vendor registered named " . $name);

        return true;
    }

    /**
     * Update vendor
     *
     * @param integer $id
     * @param string $name
     * @param string $address
     * @param string $contact
     * @param string $tin
     * @return boolean
     */
    public function Update(
        int $id,
        string $name,
        string $address,
        string $contact,
        string $tin
    ): bool {
        // Save data
        $ok = $this->vendor_repository->Save($id, $name, $address, $contact, $tin);
        if (!$ok) return false;

        // Write log
        Log::info("Vendor updated named " . $name);

        return true;
    }

    /**
     * Delete vendor
     *
     * @param integer $id
     * @return boolean
     */
    public function Delete(int $id): bool
    {
        // Delete vendor
        $deleted = $this->vendor_repository->Delete($id);
        if (!$deleted) return false;

        // Write log
        Log::info("Vendor deleted");
        return true;
    }
}
