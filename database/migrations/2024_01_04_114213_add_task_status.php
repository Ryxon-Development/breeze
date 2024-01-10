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
        //create table task_status with fields id, label
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //remove table task_status
        Schema::dropIfExists('task_status');
    }
};
