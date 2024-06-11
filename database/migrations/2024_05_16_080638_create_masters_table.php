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
        Schema::create('masters', function (Blueprint $table) {
            $table->id(); // ID
            $table->string('master_key', 3); // マスターキー
            $table->string('master_name', 128); // マスター名
            $table->string('item_code', 5); // 項目コード
            $table->string('item_name', 128); // 項目名
            $table->string('item_nm_short', 64)->nullable(); // 項目名（略語）
            $table->string('item_nm_eng', 128)->nullable(); // 項目名（英語）
            $table->unsignedInteger('order')->nullable(); // 整列順
            $table->boolean('use_flag')->default(true); // 使用フラッグ
            $table->text('remarks')->nullable(); // 備考
            $table->timestamps(); // 作成日時及び変更日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};
