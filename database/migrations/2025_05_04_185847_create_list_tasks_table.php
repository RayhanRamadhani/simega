<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('list_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idtask');
            $table->foreign('idtask')->references('idtask')->on('tasks')->onDelete('cascade');
            $table->unsignedBigInteger('userid')->default(null)->nullable();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->string('listname');
            $table->date('date');
            $table->time('time');
            $table->text('description');
            $table->boolean('isdone')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_tasks');
    }
};
