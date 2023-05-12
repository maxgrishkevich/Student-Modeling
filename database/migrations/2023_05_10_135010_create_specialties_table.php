<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('university_id');
            $table->foreign('university_id')->references('id')
                ->on('universities')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('id')
                ->on('faculties')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedInteger('code');
            $table->string('name');
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
        Schema::dropIfExists('specialties');
    }
}
