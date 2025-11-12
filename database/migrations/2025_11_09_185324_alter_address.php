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
        Schema::table('address', function (Blueprint $table) {
            //
            $table->string('per_address');
            $table->string('per_city');
            $table->string('per_state');
            $table->string('curr_address');
            $table->string('curr_city');
            $table->string('curr_state');
            $table->dropColumn(['type' ,'line1' , 'line2' ,'city' ,'state']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('address', function (Blueprint $table) {
            //
            $table->dropColumn(['per_address' , 'per_city' , 'per_state','curr_address' , 'curr_city' ,'curr_state']);
        });
    }
};
