<?php

use App\Models\Product;
use App\Models\Variable;
use App\Models\VariableValue;
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
        Schema::create('product_variant_attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Variable::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(VariableValue::class)->constrained()->cascadeOnDelete();
            $table->unique(['product_id', 'variable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attribute');
    }
};
