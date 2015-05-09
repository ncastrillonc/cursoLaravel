<?php

class Usuario extends Eloquent {

  protected $table = 'usuario';

  public function misPublicaciones() {
    return Publicacion::where('receptor', $this->id)
            ->where('tipo', 0)
            ->orderBy('id', 'desc')
            ->get();
  }
  
  
  public function misAmigos(){
    return Usuario::where('id','<>', $this->id)
            ->get();
  }
  
  
  public function leGustaPublicacion($publicacion){
    return Megusta::where('usuario_id', $this->id)
                ->where('publicacion_id', $publicacion)
                ->count()>0;
  }

  
  public function yaNoLeGustaPublicacion($publicacion){
    return Megusta::where('usuario_id', $this->id)
                ->where('publicacion_id', $publicacion)
                ->delete();
  }
}
