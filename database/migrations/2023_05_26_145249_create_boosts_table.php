<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boosts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')
                ->on('students')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')
                ->on('subjects')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('status');
            $table->text('link');
            $table->string('title');
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
        Schema::dropIfExists('boosts');
    }
}
