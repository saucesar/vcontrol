<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReasonsTable extends Migration
{
    public function up()
    {
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('company_id', false, true)->foreign('company_id')->references('id')->on('companies');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reasons');
    }
}
