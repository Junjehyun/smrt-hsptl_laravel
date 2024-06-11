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
        Schema::create('customers', function (Blueprint $table) {

            $table->id(); // ID
            $table->string('customer_no', 32); // 患者番号
            $table->string('name', 32); // 氏名
            $table->string('sex', 2)->default('1'); // 性別
            $table->string('birthdate', 8); // 生年月日
            $table->string('telephone', 32); // 電話番号
            $table->string('address', 200)->nullable(); // 住所
            $table->string('ward_code', 10)->nullable(); // 病棟
            $table->string('room_code', 10)->nullable(); // 病室
            $table->string('bed_no', 5)->nullable(); // ベッド番号
            $table->string('blood_type', 10); // 血液型
            $table->string('severity', 8)->nullable(); // 重症度
            $table->string('fall', 8)->nullable(); // 転倒
            $table->dateTime('hospitalized_date'); // 入院日
            $table->text('remarks')->nullable(); // 備考
            $table->string('old_ward_code', 10)->nullable(); // 以前の病棟
            $table->string('old_room_code', 10)->nullable(); // 以前の病室
            $table->string('old_bed_no', 5)->nullable(); // 以前のベッド番号
            $table->string('status', 2)->default('01'); // ステータス（入院中:01、退院済:03）
            $table->unsignedBigInteger('device_seq')->nullable(); // デバイス SEQ
            $table->string('device_name', 100)->nullable(); // デバイス名
            $table->unsignedBigInteger('creator_id')->nullable(); // 作成者ID
            $table->unsignedBigInteger('updater_id')->nullable(); // 修正者ID
            $table->timestamps(); // 作成日時及び変更日時
            $table->softDeletes(); // 削除日時
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('customers');
    }
};
