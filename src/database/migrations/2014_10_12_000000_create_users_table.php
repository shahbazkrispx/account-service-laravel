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
            $table->bigIncrements('id');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('gender', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->string('zip_code', 10)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('county', 50)->nullable();
            $table->string('image', 191)->nullable();
            $table->string('ssn', 191)->nullable(); // Social Security No.
            $table->string('driving_license', 191)->nullable();
            $table->string('notification_id', 191)->nullable(); // Push notification id
            $table->timestamp('last_login')->nullable();
            $table->boolean('active')->default(true);
            $table->string('ip', 150)->nullable();
            $table->string('user_agent', 250)->nullable(); // takes user browser info
            $table->string('user_os', 200); // takes user OS info
            $table->rememberToken();
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
    }
}
