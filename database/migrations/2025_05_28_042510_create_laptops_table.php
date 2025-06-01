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
        if (!Schema::hasTable('laptops')) {
            Schema::create('laptops', function (Blueprint $table) {
                $table->id();
                $table->string('image')->nullable();
                $table->string('name');
                $table->string('brand');
                $table->integer('price')->nullable();

                // desain
                $table->string('type')->nullable();
                $table->integer('weight')->nullable();
                $table->integer('thickness')->nullable();

                // display
                $table->integer('screen_size')->nullable();
                $table->integer('screen_width')->nullable();
                $table->integer('screen_height')->nullable();
                $table->string('resolution')->nullable();
                $table->integer('pixel_density')->nullable();
                $table->string('display_type')->nullable();
                $table->integer('brightness')->nullable();
                $table->integer('refresh_rate')->nullable();

                // performance
                $table->string('cpu')->nullable();
                $table->integer('cpu_speed')->nullable();
                $table->integer('cpu_thread')->nullable();
                $table->string('gpu')->nullable();
                $table->integer('ram')->nullable();
                $table->integer('ram_speed')->nullable();
                $table->integer('vram')->nullable();
                $table->string('storage_type')->nullable();
                $table->integer('internal_storage')->nullable();

                // benchmark
                $table->integer('cpu_benchmark')->nullable();
                $table->integer('cpu_benchmark_multithread')->nullable();
                $table->integer('gpu_benchmark')->nullable();

                // battery
                $table->integer('battery_size')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
