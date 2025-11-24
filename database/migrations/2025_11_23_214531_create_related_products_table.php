<?php

use App\Models\Product;
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
        Schema::create('related_products', function (Blueprint $table) {
            $table->foreignIdFor(Product::class, 'relatable_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class, 'related_id')->constrained()->cascadeOnDelete();
            $table->primary([
                'relatable_id', 'related_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_products');
    }
};
