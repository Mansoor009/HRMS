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
        Schema::create('leave_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id")->index();
            $table->string('title',40);
            $table->date('from_leave');
            $table->date('to_leave');
            $table->string('description',140);
            $table->boolean('status')->nullable()->comment('1 = approved, 0 = denied, null = pending');
            $table->string('leave_type')->comment('1 = sick leave,2 = festive leave, 3 = paid leave');
            $table->integer('no_of_days')->comment('No. of Leave taken');
            $table->string('reject_reason',140);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_records');
    }
};
