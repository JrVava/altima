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
        if(!Schema::hasColumn('users_details', 'frame_id')){
            Schema::table('users_details', function (Blueprint $table) {
                $table->unsignedBigInteger('frame_id')->nullable();
                $table->foreign('frame_id')->references('id')->on('frame');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
