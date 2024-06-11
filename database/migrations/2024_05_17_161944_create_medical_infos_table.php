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
        Schema::create('medical_infos', function (Blueprint $table) {
            $table->id(); // ID
            $table->string('customer_no', 32); // 患者番号
            $table->string('department', 32); // 診療科
            $table->string('doctor_name', 32); // 医師名
            $table->string('department_code', 8); // 診療科コード
            $table->string('severity', 8); //　重症度 
            $table->string('fall', 8); // 落傷
            $table->boolean('blood_warn')->default(false); // 血液型
            $table->boolean('contact_warn')->default(false); // 接触注意
            $table->boolean('air_warn')->default(false); // 空気注意
            $table->boolean('current_flag')->default(true); // 現在フラグ
            $table->text('remarks')->nullable(); // 備考
            $table->unsignedBigInteger('creator_id')->nullable(); // 作成者ID
            $table->unsignedBigInteger('updater_id')->nullable(); // 修正者ID
            $table->timestamps(); // 作成日時及び変更日時
            $table->softDeletes(); // 削除日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_infos');
    }
};
