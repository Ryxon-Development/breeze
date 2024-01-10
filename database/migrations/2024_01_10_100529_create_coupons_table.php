<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Coupon;
//Use CouponFactory and CouponSeeder
use Database\Factories\CouponFactory;
use Database\Seeders\CouponSeeder;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('value');
            $table->integer('used')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Run seeder using Artisan command
        Artisan::call('db:seed', ['--class' => 'CouponSeeder']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
