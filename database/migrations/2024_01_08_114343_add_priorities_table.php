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
        //create priorities table with fields id, label
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('label');
        });
        //now create 3 priorities
        DB::table('priorities')->insert([
            ['label' => 'Low'],
            ['label' => 'Medium'],
            ['label' => 'High'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
