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
        Schema::create('smart_tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_id', 16)->unique();
            $table->string('mac_address', 32)->nullable()->unique();
            $table->string('tag_location', 32)->nullable();
            $table->string('tag_location_nm', 128)->nullable();
            $table->string('tag_type', 2)->nullable();
            $table->string('gateway_ip', 32)->nullable();
            $table->string('job_type', 16)->nullable();
            $table->string('job_result', 16)->nullable();
            $table->string('battery_charge_rate', 8)->nullable();
            $table->string('temperature', 8)->nullable();
            $table->string('receive_power', 8)->nullable();
            $table->string('version', 8)->nullable();
            $table->boolean('use_flag')->default(false);
            $table->string('old_tag_location', 32)->nullable();
            $table->string('old_tag_location_nm', 128)->nullable();
            $table->dateTime('latest_update')->nullable();
            $table->bigInteger('creator_id')->nullable();
            $table->bigInteger('updater_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_tags');
    }
};
