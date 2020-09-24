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
            $table->id();
            $table->string('name',50);
            $table->string('username',50);
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address')->nullable();
            $table->string('phone',20)->nullable();
            $table->boolean('sex');
            $table->dateTime('birthday');
            $table->tinyInteger('job')->nullable();
            $table->text('about')->default('');
            $table->string('about_title')->default("About Me");
            $table->text('pr_message')->nullable();
            $table->Integer('height')->nullable();
            $table->tinyInteger('figure')->nullable();
            $table->tinyInteger('anual_income')->nullable();
            $table->tinyInteger('matching_expect')->nullable();
            $table->tinyInteger('holiday')->nullable();
            $table->tinyInteger('aca_background')->nullable();
            $table->tinyInteger('alcohol')->nullable();
            $table->tinyInteger('tabaco')->nullable();
            $table->tinyInteger('birthplace')->nullable();
            $table->tinyInteger('housemate')->nullable();
            $table->string('password',100);
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
