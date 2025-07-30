<?php

use App\Models\Variable;
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
        Schema::create('variable_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Variable::class)->constrained()->cascadeOnDelete();
            $table->string('value');
            $table->string('value_hash');
            $table->string('type_value')->nullable();
            $table->timestamps();
            $table->unique(['variable_id', 'value_hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variable_values');
    }
};
