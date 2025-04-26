<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); 
            $table->integer('duration_month')->default(0);
            $table->integer('price')->default(0);
            $table->json('features')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
