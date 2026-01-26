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
        Schema::create('nadzir_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nadzir_id')->constrained()->cascadeOnDelete();
            $table->string('type', 50)->index();
            $table->string('file_path');
            $table->timestamps();

            $table->unique(['nadzir_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nadzir_documents');
    }
};
