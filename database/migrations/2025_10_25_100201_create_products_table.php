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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description');
                $table->decimal('price', 12, 2);
                $table->integer('stock')->default(0);
                $table->foreignId('region_id')->constrained()->onDelete('cascade');
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
                $table->string('material')->nullable();
                $table->text('size_info')->nullable();
                $table->text('care_instructions')->nullable();
                $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
