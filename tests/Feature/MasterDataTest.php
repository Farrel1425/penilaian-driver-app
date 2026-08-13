<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MasterDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_master_data_pages_require_authentication(): void
    {
        $this->get(route('admin.branches.index'))->assertRedirect(route('login'));
        $this->get(route('admin.drivers.index'))->assertRedirect(route('login'));
        $this->get(route('admin.vehicles.index'))->assertRedirect(route('login'));
    }

    public function test_admin_can_create_update_and_deactivate_branch(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('admin.branches.store'), [
            'code' => 'TST-001',
            'name' => 'Cabang Test',
            'address' => 'Alamat Test',
            'status' => Branch::STATUS_ACTIVE,
        ]);

        $branch = Branch::query()->where('code', 'TST-001')->firstOrFail();
        $response->assertRedirect(route('admin.branches.show', $branch));

        $this->put(route('admin.branches.update', $branch), [
            'code' => 'TST-002',
            'name' => 'Cabang Update',
            'address' => 'Alamat Update',
            'status' => Branch::STATUS_ACTIVE,
        ])->assertRedirect(route('admin.branches.show', $branch));

        $this->patch(route('admin.branches.toggle-status', $branch))->assertRedirect();
        $this->assertSame(Branch::STATUS_INACTIVE, $branch->fresh()->status);
    }

    public function test_admin_can_create_driver_without_vehicle_assignment(): void
    {
        $this->actingAs(User::factory()->create());
        $branch = Branch::factory()->create();

        $this->post(route('admin.drivers.store'), [
            'branch_id' => $branch->id,
            'full_name' => 'Budi Driver',
            'nickname' => 'Budi',
            'birth_place' => 'Denpasar',
            'birth_date' => '1990-01-01',
            'gender' => 'male',
            'address' => 'Denpasar',
            'phone' => '08123456789',
            'email' => 'budi@example.com',
            'photo' => null,
            'sim_number' => 'SIM123',
            'sim_type' => 'A',
            'sim_expired_at' => '2030-01-01',
            'sim_photo' => null,
            'join_date' => '2026-01-01',
            'status' => Driver::STATUS_ACTIVE,
        ])->assertRedirect();

        $driver = Driver::query()->where('full_name', 'Budi Driver')->firstOrFail();

        $this->assertSame($branch->id, $driver->branch_id);
        $this->assertFalse(\Illuminate\Support\Facades\Schema::hasColumn('drivers', 'vehicle_id'));
    }

    public function test_admin_can_create_vehicle_and_regenerate_qr_token(): void
    {
        $this->actingAs(User::factory()->create());
        $branch = Branch::factory()->create();

        $this->post(route('admin.vehicles.store'), [
            'branch_id' => $branch->id,
            'police_number' => 'DK 1234 AB',
            'brand' => 'Toyota',
            'model' => 'Avanza',
            'year' => 2024,
            'color' => 'Putih',
            'chassis_number' => null,
            'engine_number' => null,
            'fuel_type' => 'bensin',
            'transmission' => 'manual',
            'passenger_capacity' => 6,
            'acquisition_date' => null,
            'acquisition_source' => null,
            'ownership_type' => 'owned',
            'contract_number' => null,
            'contract_expired_at' => null,
            'description' => null,
            'photo' => null,
            'status' => Vehicle::STATUS_ACTIVE,
        ])->assertRedirect();

        $vehicle = Vehicle::query()->where('police_number', 'DK 1234 AB')->firstOrFail();
        $oldToken = $vehicle->qr_token;

        $this->assertNotEmpty($oldToken);

        $this->patch(route('admin.vehicles.regenerate-qr', $vehicle))->assertRedirect();

        $this->assertNotSame($oldToken, $vehicle->fresh()->qr_token);
    }
    public function test_admin_master_data_pages_can_be_rendered(): void
    {
        $this->actingAs(User::factory()->create());
        $branch = Branch::factory()->create();
        $driver = Driver::factory()->for($branch)->create();
        $vehicle = Vehicle::factory()->for($branch)->create();

        $this->get(route('admin.branches.index'))->assertOk();
        $this->get(route('admin.branches.create'))->assertOk();
        $this->get(route('admin.branches.show', $branch))->assertOk();
        $this->get(route('admin.branches.edit', $branch))->assertOk();

        $this->get(route('admin.drivers.index'))->assertOk();
        $this->get(route('admin.drivers.create'))->assertOk();
        $this->get(route('admin.drivers.show', $driver))->assertOk();
        $this->get(route('admin.drivers.edit', $driver))->assertOk();

        $this->get(route('admin.vehicles.index'))->assertOk();
        $this->get(route('admin.vehicles.create'))->assertOk();
        $this->get(route('admin.vehicles.show', $vehicle))->assertOk();
        $this->get(route('admin.vehicles.edit', $vehicle))->assertOk();
    }
}
