<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('object_maintenance_visits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->date('planning_date')->nullable();
            $table->date('execution_date')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('workorder_number')->nullable();
            $table->integer('maintenance_company_id')->nullable();
            $table->integer('elevator_id')->nullable();
            $table->longText('remark')->nullable();
	        $table->longText('document')->nullable();

            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_maintenance_visits');
    }
};