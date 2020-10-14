<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
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
            $table->smallInteger('job')->nullable();
            $table->text('about')->nullable();
            $table->string('about_title')->default("About Me");
            $table->text('pr_message')->nullable();
            $table->Integer('height')->nullable();
            $table->smallInteger('figure')->nullable();
            $table->smallInteger('anual_income')->nullable();
            $table->smallInteger('matching_expect')->nullable();
            $table->smallInteger('holiday')->nullable();
            $table->smallInteger('aca_background')->nullable();
            $table->smallInteger('alcohol')->nullable();
            $table->smallInteger('tabaco')->nullable();
            $table->smallInteger('birthplace')->nullable();
            $table->smallInteger('housemate')->nullable();
            $table->tinyInteger('pickup_status')->default('0');
            $table->string('password',100);
            $table->string('api_token', 80)->unique()->default();
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
