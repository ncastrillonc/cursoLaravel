<?php

class Publicacion extends Eloquent{
  
  protected $table = 'publicacion';
  
  
   public function freshTimestamp() {
    return date('Y-m-d h:i:s');
  }
  
  public function leGustaA($usuario) {
    return Megusta::where('publicacion_id', $this->id)
                ->where('usuario_id', $usuario)
                ->count()>0? 'Ya no me gusta' : 'Me gusta';
  }
    
  
  public static function likes($id){
    return Megusta::where('publicacion_id', $id)
            ->count();
    
  }
  
   public function comentarios() {
    return Publicacion::where('padre', $this->id)
                ->where('tipo', 1)
                ->get();
  }
}
