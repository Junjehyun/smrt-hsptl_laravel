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
        Schema::create('medical_comments', function (Blueprint $table) {
            $table->id(); // ID
            $table->string('customer_no', 32); // 患者番号, 외래키
            $table->string('department_code', 8)->nullable(); // 診療科コード
            $table->string('employ_id', 32)->nullable(); // スタッフID
            $table->text('comments')->nullable(); // 備考
            $table->dateTime('create_date'); // 作成日時
            $table->timestamps(); // 登録日時、更新日時
            $table->softDeletes(); // 削除日時

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_comments');
    }
};
