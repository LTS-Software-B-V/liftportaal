<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('asset_categories');
            $table->string('name');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
        });

        Schema::create('asset_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
        });

        Schema::create('asset_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('asset_brands');
            $table->foreignId('category_id')->constrained('asset_categories');
            $table->string('name');
            $table->decimal('price', total: 12, places: 2)->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('asset_categories');
            $table->foreignId('model_id')->nullable()->constrained('asset_models');
            $table->foreignId('location_id')->nullable()->constrained('locations');
            $table->foreignId('supplier_id')->nullable()->constrained('companies');
            $table->nullableMorphs('claimer');
            $table->string('serial_number')->nullable();
            $table->decimal('price', total: 12, places: 2)->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
        Schema::dropIfExists('asset_models');
        Schema::dropIfExists('asset_brands');
        Schema::dropIfExists('asset_categories');
    }
};