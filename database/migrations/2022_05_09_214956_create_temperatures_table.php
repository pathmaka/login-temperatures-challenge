<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemperaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperatures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('chicago'); 
            $table->string('colombo');
            $table->timestamps();
        });

        // Schema::table('temperatures', function (Blueprint $table) {
        //     $table->renameColumn('fahrenheit', 'chicago');
        //     $table->renameColumn('celsius', 'colombo');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temperatures');
    }
}
