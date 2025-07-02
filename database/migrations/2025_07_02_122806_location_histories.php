<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('location_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('explorer_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->unique(['explorer_id', 'item_id']);
            $table->index(['latitude', 'longitude']);
            $table->index(['item_id', 'latitude', 'longitude']);
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
