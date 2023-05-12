<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique('user_id');
            $table->boolean('employment_status');
            $table->unsignedFloat('experience');
            $table->unsignedFloat('off_experience');
            $table->string('field');
            $table->string('position');
            $table->enum('level', ['intern', 'junior', 'strong junior', 'middle', 'strong middle', 'senior']);
            $table->enum('eng_level', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences');
    }
}
