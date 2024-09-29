<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('contact_no')->unique();
            $table->string('username')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('designation')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('gender')->default(1)->comment('1=>Male,2=>Female,3=>Other');
            // $table->string('class')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('class_lists')->onDelete('cascade');
            $table->string('emergency_contact')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religeon')->nullable();
            $table->string('school_name')->nullable();
            $table->text('present_address')->nullable();
            $table->text('parmanent_address')->nullable();
            $table->unsignedBigInteger('role_id')->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->string('password');
            $table->string('remember_password')->nullable();
            $table->string('image')->nullable();
            $table->boolean('full_access')->default(false)->comment('1=>yes 0=>no');
            $table->integer('status')->default(false)->comment('1=>active 0=>inactive');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('users')->insert([
            ['name' => '',
            'email' => 'admin@gmail.com',
            'contact_no' => '1',
            'role_id' => '1',
            'password' => Hash::make(123),
            'status' => 1,
            'full_access' => 1],
            ['name' => '',
            'email' => 'student@gmail.com',
            'contact_no' => '2',
            'role_id' => '2',
            'password' => Hash::make(123),
            'status' => 1,
            'full_access' => 0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};