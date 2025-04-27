<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('property_type_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_type_id')->references('id')->on('property_types');
            $table->decimal('price', 15, 2);
            $table->string('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->string('address');
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->decimal('size', 10, 2);
            $table->string('measurement')->default('m²');
            $table->text('description');
            $table->string('status_id');
            $table->foreign('status_id')->references('id')->on('property_statuses');
            $table->boolean('approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
