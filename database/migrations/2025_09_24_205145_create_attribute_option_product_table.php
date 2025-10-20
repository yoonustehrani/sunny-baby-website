<?php

use App\Models\Attribute;
use App\Models\AttributeOption;
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
        Schema::create('attribute_option_product', function (Blueprint $table) {
            $table->foreignIdFor(AttributeOption::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Attribute::class)->constrained()->cascadeOnDelete();
            $table->primary(['product_id', 'attribute_option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_option_product');
    }
};
