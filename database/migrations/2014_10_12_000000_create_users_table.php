<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Seccion 4 - 10: creacion de la tabla por orden a la fecha y los requerimientos necesarios para la foreing kay de la tablas
        Schema::create('roles', function (Blueprint $table) {
    		$table->increments('id');
    		$table->string('name')->comment('Nombre del rol de usuario');
    		$table->text('description');
    		$table->timestamps();
        });
        //Seccion 4 - 10: terminar los componenetes de las tablas en este ejemplo se puede crear por create o table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            //llama al complemento para que el valor ingresado sea poder defecto STUDENT
            $table->unsignedInteger('role_id')->default(\App\Role::STUDENT);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('name');
	        $table->string('last_name')->nullable();
	        $table->string('slug');
            $table->string('email')->unique();
            $table->string('password')->nullable();
	        $table->string('picture')->nullable();
	        //cashier columns
	        $table->string('stripe_id')->nullable();
	        $table->string('card_brand')->nullable();
	        $table->string('card_last_four')->nullable();
	        $table->timestamp('trial_ends_at')->nullable();
            //rememberToken registro de usuarios almacenados en cookie para usuarios confiables
	        $table->rememberToken();
	        $table->timestamps();
        });
        //Seccion 
        Schema::create('subscriptions', function (Blueprint $table) 
        {
            $table->increments('id');
            //unsignedInteger nos permites usar numeros positivos y numeros enteros
		    $table->unsignedInteger('user_id');
		    $table->foreign('user_id')->references('id')->on('users');
		    $table->string('name');
		    $table->string('stripe_id');
		    $table->string('stripe_plan');
		    $table->integer('quantity');
		    $table->timestamp('trial_ends_at')->nullable();
		    $table->timestamp('ends_at')->nullable();
		    $table->timestamps();
        });
        Schema::create('user_social_accounts', function(Blueprint $table)
	    {
            $table->increments('id');
            //unsignedInteger nos permites usar numeros positivos y numeros enteros
		    $table->unsignedInteger('user_id');
		    $table->foreign('user_id')->references('id')->on('users');
		    $table->string('provider');
		    $table->string('provider_uid');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Seccion 4 -10: ejecucion de los datos para eliminar las tablas al momento de realizar un rollback
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('user_social_accounts');
    }
}
