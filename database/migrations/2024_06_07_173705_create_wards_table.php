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
        Schema::create('wards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ward_type', 2)->default('01');
            $table->string('ward_code', 10);
            $table->string('ward_name', 100);
            $table->text('ward_description')->nullable();
            $table->string('coordinator_code', 5)->nullable();
            $table->string('bgcolor', 7)->nullable();
            $table->string('image_name', 200)->nullable();
            $table->string('remarks', 200)->nullable();
            $table->timestamps(); // created_at, updated_at カラムの作成
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
