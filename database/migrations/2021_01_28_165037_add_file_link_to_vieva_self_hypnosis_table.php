<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileLinkToVievaSelfHypnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vieva_self_hypnosis', function (Blueprint $table) {
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
        Schema::table('vieva_self_hypnosis', function (Blueprint $table) {
            $table->dropColumn('file_link');
        });
    }
}
