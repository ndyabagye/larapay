<?php

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'tenant_id')->constrained(
                table: 'users', indexName: 'maintenance_requests_tenant_id'
            )->onDelete('cascade');
            $table->foreignIdFor(User::class, 'contractor_id')->constrained(
                table: 'users', indexName: 'maintenance_requests_contractor_id'
            )->onDelete('cascade');
            $table->foreignIdFor(Property::class, 'property_id')->constrained()->cascadeOnDelete();
            $table->text('description');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
