<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('police_number')->unique();
            $table->string('brand');
            $table->string('model')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('color')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->unsignedSmallInteger('passenger_capacity')->nullable();
            $table->date('acquisition_date')->nullable();
            $table->string('acquisition_source')->nullable();
            $table->string('ownership_type')->nullable();
            $table->string('contract_number')->nullable();
            $table->date('contract_expired_at')->nullable();
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('status')->default('active')->index();
            $table->string('qr_token', 64)->unique();
            $table->timestamps();

            $table->index(['branch_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
