<?php

namespace Database\Seeders;

use App\Models\MaintenanceRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceRequest::factory()->count(20)->create();
    }
}
