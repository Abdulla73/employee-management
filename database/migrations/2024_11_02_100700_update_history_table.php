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
        Schema::table('histories', function (Blueprint $table) {
           $table->dropColumn('serving_year');
           $table->date('start_date')->after('position')->nullable();
           $table->date('end_date')->after('start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->string('serving_year',100);
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');

         });
    }
};