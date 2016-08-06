<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commodity_id')->nullable();
            $table->datetime('timestamp')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('market')->nullable();
            $table->string('commodity_name')->nullable();
            $table->string('variety')->nullable();
            $table->datetime('arrival_date')->nullable();
            $table->integer('min_price')->default(0);
            $table->integer('max_price')->default(0);
            $table->integer('modal_price')->default(0);
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commodities');
    }
}
