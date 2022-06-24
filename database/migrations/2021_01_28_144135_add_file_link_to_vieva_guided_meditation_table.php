<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileLinkToVievaGuidedMeditationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vieva_guided_meditation', function (Blueprint $table) {
            $table->text('file_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vieva_guided_meditation', function (Blueprint $table) {
            $table->dropColumn('file_link');
        });
    }
}
