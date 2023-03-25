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
            $table->unsignedInteger('amount');
            
            $table->unsignedBigInteger('date_id');
            $table->foreign('date_id')->references('id')->on('dates');

            $table->unsignedBigInteger('reason_id');
            $table->foreign('reason_id')->references('id')->on('reasons');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_movements');
    }
}