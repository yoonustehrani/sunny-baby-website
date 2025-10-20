<?php

use App\Models\Attribute;
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
        Schema::create('attribute_options', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Attribute::class)->constrained()->cascadeOnDelete();
            $table->string('content');
            $table->string('content_hash');
            $table->string('label')->nullable();
            $table->unique(['attribute_id', 'content_hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_options');
    }
};
