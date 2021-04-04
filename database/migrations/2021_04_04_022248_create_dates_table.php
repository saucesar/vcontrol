<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesTable extends Migration
{
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('amount', false, true);
            $table->string('lote')->nullable();
            $table->integer('product_id', false, true)->foreign('product_id')->references('id')->on('products');
            $table->integer('previous_id', false, true)->nullable();
            $table->integer('reason_id', false, true)->nullable()->foreign('reason_id')->references('id')->on('reasons');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dates');
    }
}
