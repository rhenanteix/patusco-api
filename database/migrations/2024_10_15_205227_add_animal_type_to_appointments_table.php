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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('animal_type')->nullable(); // Adiciona a coluna animal_type
        });
    }
    
    public function down()
    {
        // Schema::table('appointments', function (Blueprint $table) {
        //     $table->dropColumn('animal_type'); // Remove a coluna no rollback
        // });
    }
    
};
