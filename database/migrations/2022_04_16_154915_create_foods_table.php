<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('食品名');
            $table->string('major_category')->comment('大カテゴリー');
            $table->string('middle_category')->comment('中カテゴリー');
            $table->float('calorie')->comment('カロリー');
            $table->float('protein')->comment('タンパク質');
            $table->float('fat')->comment('脂質');
            $table->float('carbohydrate')->comment('タンパク質');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
