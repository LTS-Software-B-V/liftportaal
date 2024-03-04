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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('name')->nullable();
            $table->string('zipcode')->nullable();     
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->string('slug')->nullable();
            $table->string('complexnumber')->nullable();
            


            $table->integer('management_id')->nullable();
            $table->integer('customer_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
