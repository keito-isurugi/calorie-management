<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('sex')->comment('性別');
            $table->integer('age')->comment('年齢');
            $table->float('height', 8, 1)->comment('身長');
            $table->float('body_waight', 8, 1)->comment('体重');
            $table->float('body_fat_percentage', 8, 1)->comment('体脂肪率');
            $table->float('exercise_intensity', 8, 1)->comment('運動強度');
            $table->integer('adm_flg')->comment('管理者フラグ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
