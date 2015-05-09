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
    return Redirect::to("/profile/ver/".Input::get('receptor'));
    
  }
  public function postComentar(){
      
    if(Request::ajax()){
        
        $publicacion = Publicacion::find(Input::get('publicacion'));    // coja la publicacion que me mandaron
        $comentario = [
            'publicacion' => Input::get('comentario'),
            'tipo' => 1,
            'usuario_id' => Auth::user()->id,
            'receptor' => $publicacion->receptor,
            'padre' => $publicacion->id
        ];
        
        DB::table('publicacion')->insert($comentario);
        return Response::json($comentario);
    }
  }
 
  public function postMeGusta(){
    
    $publicacion = Input::get('publicacion');
    $usuario = Usuario::find(Auth::user()->id);
            
    if($usuario->leGustaPublicacion($publicacion)){
        $usuario->yaNoLeGustaPublicacion($publicacion);
        $data['type'] = -1;
    } else {
        $megusta = [
            'publicacion_id' => $publicacion,
            'usuario_id' => Auth::user()->id
        ];
        DB::table('me_gusta')->insert($megusta);
        $data['type'] = 1;
    }
    
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
