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
        Schema::create('facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable();
            $table->string('owner_name', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('logo_image_name', 200)->nullable();
            $table->string('logo_short_image_name', 200)->nullable();
            $table->string('background_image_name', 200)->nullable();
            $table->boolean('banner_display_flag')->default(true);
            $table->string('layout_no', 2)->nullable();
            $table->string('room_layout_no', 2)->nullable();
            $table->string('bed_layout_no', 2)->nullable();
            $table->string('status', 2);
            $table->bigInteger('license_count')->default(100);
            $table->string('lang_type', 2)->default('01');
            $table->bigInteger('creator_id')->nullable();
            $table->bigInteger('updater_id')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
