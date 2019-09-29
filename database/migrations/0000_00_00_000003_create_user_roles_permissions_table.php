<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_roles')){
            Schema::create('user_roles', function(Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('role_id');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            });
        }

        if(!Schema::hasTable('user_permissions')){
            Schema::create('user_permissions', function(Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('permission_id');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('user_roles')){
            Schema::table('user_roles', function(Blueprint $table){
                $table->dropForeign(['user_id']);
                $table->dropForeign(['role_id']);
            });
            Schema::dropTable('user_roles');
        }

        if(Schema::hasTable('user_permissions')){
            Schema::table('user_permissions', function(Blueprint $table){
                $table->dropForeign(['user_id']);
                $table->dropForeign(['permission_id']);
            });
            Schema::dropTable('user_permissions');
        }
    }
}
