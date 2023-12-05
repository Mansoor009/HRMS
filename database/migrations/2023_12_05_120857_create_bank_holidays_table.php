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
        Schema::create('bank_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('title',40);
            $table->date('date');
            $table->boolean('status')->comment('1 = approved, 0 = denied');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_holidays');
    }
};
