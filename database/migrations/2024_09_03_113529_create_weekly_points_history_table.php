<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyPointsHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('weekly_points_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_points');
            $table->date('date'); // Store the date for daily records
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weekly_points_history');
    }
}
