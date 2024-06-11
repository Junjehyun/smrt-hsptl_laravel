<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID
            $table->string('name'); // ユーザー名
            $table->string('email')->unique(); // Eメール
            $table->timestamp('email_verified_at')->nullable(); // メール検証日時
            $table->string('password'); // パスワード
            $table->string('remember_token', 100)->nullable(); // ログイン状態維持トークン
            $table->unsignedBigInteger('current_team_id')->nullable(); // 現在チームのID
            $table->string('profile_photo_path', 2048)->nullable(); // プロフィール写真
            $table->string('telephone', 16)->nullable(); // 電話番号
            $table->string('department', 32)->nullable(); // 部署情報
            $table->string('employ_id', 32)->nullable(); // 社員ID
            $table->string('roles', 3)->nullable(); // 役割
            $table->string('user_type', 3)->default('000'); // ユーザーのタイプ
                                                            // 基本値と説明追加
                                                            // 'default '000'
                                                            // 承認待機:'000', Super Admin:'777', admin:'007', 病棟管理者:'005', スタッフ：'001', 未承認:'009'"

            $table->dateTime('approval_date')->nullable(); // 承認日時
            $table->unsignedBigInteger('approval_user')->nullable(); // 承認者ID
            $table->dateTime('last_activity_date'); // 最後の活動時間
            $table->unsignedBigInteger('visit_count')->nullable(); // 訪問回数
            $table->string('wards_in_charge', 1024)->nullable(); // 担当病棟
            $table->timestamps(); // 作成日時及び変更日時
            $table->softDeletes(); // 削除日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
