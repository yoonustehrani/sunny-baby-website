<?php

use App\Enums\VariableType;
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
        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('type', 1)->default(VariableType::SIMPLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variables');
    }
};
