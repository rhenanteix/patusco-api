<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->id();
                $table->string('person_name');
                $table->string('email');
                $table->string('animal_name');
                $table->unsignedBigInteger('animal_id');
                $table->integer('animal_age');
                $table->text('symptoms');
                $table->date('appointment_date');
                $table->enum('appointment_period', ['morning', 'afternoon']);
                $table->unsignedBigInteger('doctor_id')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
