<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to the user who submitted the report
            $table->foreignId('attendance_id')->constrained()->onDelete('cascade'); // Reference to the attendance record
            $table->string('report'); // The report text
            $table->timestamp('reported_at')->useCurrent(); // Timestamp for when the report was submitted
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
