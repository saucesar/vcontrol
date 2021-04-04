<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('category_emails', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->foreign('category_id')->references('id')->on('categories');
            $table->integer('email_id')->foreign('email_id')->references('id')->on('emails');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_emails');
    }
}
