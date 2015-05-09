<?php

class PublicacionController extends BaseController{
  
  public function postCrear(){   
    $publicacion = [
        'publicacion' => Input::get('publicacion'),
        'tipo' => '0',
        'usuario_id' => Auth::user()->id,
        'receptor' => Input::get('receptor')
    ];
    DB::table('publicacion')->insert($publicacion);
    return Redirect::to("/profile");
    
  }
  public function postComentar(){
    
  }
 
  public function postMeGusta(){
    
      $publicacion = Input::get('publicacion');
    
      $megusta = [
          'publicacion_id' => $publicacion,
          'usuario_id' => Auth::user()->id
      ];
      DB::table('me_gusta')->insert($megusta);
      
      $data['nlikes'] = Publicacion::likes($publicacion);
      
     return Response::json($data);
    
  }
 
  
  public function getEliminar($id){
    $publicacion = Publicacion::find($id);
    if($publicacion && $publicacion->usuario_id == Auth::user()->id){
      $publicacion->delete();
    }
    return Redirect::to("/profile");
    
  }
  
  
  
  
  
}
