<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('username')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('picture')->default('dummy_character.png');
            $table->string('is_verified')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('school_year')->nullable();
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('picture')->default('dummy_company.png');
            $table->string('contact')->nullable();
            $table->longText('address')->nullable();
            $table->string('email')->nullable();
            $table->string('lng')->nullable();
            $table->string('lat')->nullable();
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_number')->nullable();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('company_id')->nullable();
            $table->string('section_id')->nullable();
            $table->longText('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('sex')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->string('remaining_time')->nullable();
            $table->timestamps();
        });

        Schema::create('requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('requirement_student', function (Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->integer('requirement_id')->unsigned();
            $table->string('attachment')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('requirement_id')->references('id')->on('requirements')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['student_id', 'requirement_id']);
        });

        Schema::create('timesheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->longText('task')->nullable();
            $table->string('duration')->nullable();
            $table->string('is_checked')->default(false);
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('students');
        Schema::dropIfExists('requirements');
        Schema::dropIfExists('requirement_student');
        Schema::dropIfExists('timesheets');
        Schema::dropIfExists('posts');
    }
}
