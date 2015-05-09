<?php

Route::get('/', function()
{ 
    if(Auth::check()){
      return Redirect::to("/profile");
    }
    return View::make('general.login');	
});


Route::post('/loguear', function(){
    $email = Input::get('correo');
    $password = Input::get('password');
    if(Auth::attempt(['correo'=>$email, 'password'=> $password])){
     return Redirect::to("/profile");
    }else{
      echo "el usuario no está logueado";
    }
});



Route::group(array('before' => 'auth'), function() {

  Route::controller('publicacion','PublicacionController');
  Route::controller('profile','ProfileController');

});