<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->date('birth');
            $table->enum('sex', ['чоловіча', 'жіноча']);
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')
                ->on('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('entry_date');
            $table->date('graduation_date');
            $table->enum('educational_degree', ['бакалавр', 'магістр', 'аспірант']);
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
        Schema::dropIfExists('applications');
    }
}
