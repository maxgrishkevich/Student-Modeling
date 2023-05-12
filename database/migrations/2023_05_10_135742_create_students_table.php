<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique('user_id');

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')
                ->on('groups')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('image');
            $table->date('birth');
            $table->enum('sex', ['чоловіча', 'жіноча']);
            $table->date('entry_date');
            $table->date('graduation_date');
            $table->enum('educational_degree', ['бакалавр', 'магістр', 'аспірант']);
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
        Schema::dropIfExists('students');
    }
}
