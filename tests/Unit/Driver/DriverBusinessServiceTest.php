<?php

namespace Tests\Unit\Driver;

use App\Service\Driver\DriverBusinessService;
use Tests\TestCase;

class DriverBusinessServiceTest extends TestCase
{
    private DriverBusinessService $driver_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->driver_service = DriverBusinessService::getInstance();
    }

    public function test_singleton()
    {
        $this->assertTrue($this->driver_service === DriverBusinessService::getInstance());
    }

    public function test_register()
    {
        $ok = $this->driver_service->Register(
            'Test1',
            'Address1',
            '083918231231',
            32120941802231,
            2120419241093
        );

        $this->assertTrue($ok);
    }

    public function test_get()
    {
        $drivers = $this->driver_service->Get();

        $this->assertNotEmpty($drivers);
    }

    public function test_get_detail()
    {
        $driver = $this->driver_service->GetDetail(1);

        $this->assertIsArray($driver);
        $this->assertArrayHasKey('id', $driver);
    }
}
