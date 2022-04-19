<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFoodsTableFloatDigit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->float('amount', 8, 1)->change();
            $table->float('calorie', 8, 1)->change();
            $table->float('protein', 8, 1)->change();
            $table->float('fat', 8, 1)->change();
            $table->float('carbohydrate', 8, 1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
