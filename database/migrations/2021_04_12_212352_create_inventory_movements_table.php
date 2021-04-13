<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryMovementsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['in', 'out']);
            $table->integer('amount', false, true);
            $table->unsignedDouble('value');
            $table->integer('date_id', false, true)->foreign('date_id')->references('id')->on('dates');
            $table->integer('reason_id', false, true)->nullable()->foreign('reason_id')->references('id')->on('reasons');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_movements');
    }
}
