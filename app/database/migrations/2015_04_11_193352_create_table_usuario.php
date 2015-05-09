<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuario extends Migration {


	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('correo');      
			$table->string('password');    
      $table->timestamps();  
      $table->rememberToken(); 
		});
    
		Schema::create('publicacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('publicacion');
			$table->boolean('tipo'); 
      $table->integer('usuario_id')->unsigned();
      $table->integer('receptor')->unsigned();
      $table->integer('padre')->unsigned()->nullable();
      $table->foreign('usuario_id')->references('id')->on('usuario');
      $table->foreign('receptor')->references('id')->on('usuario');
      $table->foreign('padre')->references('id')->on('publicacion');
      $table->timestamps();    
		});
		Schema::create('me_gusta', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('publicacion_id')->unsigned();
      $table->integer('usuario_id')->unsigned();
      $table->foreign('publicacion_id')->references('id')->on('publicacion');
      $table->foreign('usuario_id')->references('id')->on('usuario');
      $table->timestamps();    
		});
    
    
    DB::table('usuario')
            ->insert([
                'nombre' => 'Andrés',
                'correo' => 'andr3s2@gmail.com',
                'password' => Hash::make('123')
            ]);
    DB::table('usuario')
            ->insert([
                'nombre' => 'Luis',
                'correo' => 'luismec90@gmail.com',
                'password' => Hash::make('123')
            ]);
        DB::table('usuario')
            ->insert([
                'nombre' => 'Luis',
                'correo' => 'luismec90@gmail.com',
                'password' => Hash::make('123')
            ]);
            DB::table('usuario')
            ->insert([
                'nombre' => 'Luis',
                'correo' => 'luismec90@gmail.com',
                'password' => Hash::make('123')
            ]);
                DB::table('usuario')
            ->insert([
                'nombre' => 'Daniel',
                'correo' => 'daniel@gmail.com',
                'password' => Hash::make('123')
            ]);
                    DB::table('usuario')
            ->insert([
                'nombre' => 'Pedro',
                'correo' => 'pedro@gmail.com',
                'password' => Hash::make('123')
            ]);
                        DB::table('usuario')
            ->insert([
                'nombre' => 'Julian',
                'correo' => 'julian@gmail.com',
                'password' => Hash::make('123')
            ]);
                            DB::table('usuario')
            ->insert([
                'nombre' => 'Ximena',
                'correo' => 'ximena@gmail.com',
                'password' => Hash::make('123')
            ]);
            
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('me_gusta');
		Schema::drop('publicacion');
		Schema::drop('usuario');
	}

}
