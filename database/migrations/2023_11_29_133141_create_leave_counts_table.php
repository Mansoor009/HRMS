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
        Schema::create('leave_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id")->index();
            $table->integer('sick_leave');
            $table->integer('paid_leave');
            $table->integer('festive_leave');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_counts');
    }
};
