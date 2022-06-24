<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVievaQuizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vieva_quizes', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_text');
            $table->Integer('lesson_id');
            $table->string('is_active');
            $table->timestamps();

            $table->foreign('lesson_id')->references('lesson_id')->on('vieva_video_lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vieva_quizes');
    }
}
