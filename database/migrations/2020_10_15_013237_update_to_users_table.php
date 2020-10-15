<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users',function(Blueprint $table){
                $table->smallInteger('figure')->nullable()->after('height')->change();
                $table->smallInteger('anual_income')->nullable()->change();
                $table->smallInteger('matching_expect')->nullable()->change();
                $table->smallInteger('holiday')->nullable()->change();
                $table->smallInteger('aca_background')->nullable()->change();
                $table->smallInteger('alcohol')->nullable()->change();
                $table->smallInteger('tabaco')->nullable()->change();
                $table->smallInteger('birthplace')->nullable()->change();
                $table->smallInteger('housemate')->nullable()->change();
    
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('figure');
            $table->dropColumn('anual_income');
            $table->dropColumn('matching_expect');
            $table->dropColumn('holiday');
            $table->dropColumn('aca_background');
            $table->dropColumn('alcohol');
            $table->dropColumn('tabaco');
            $table->dropColumn('birthplace');
            $table->dropColumn('housemate');
        });
    }
}
