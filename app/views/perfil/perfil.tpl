{capture assign="left"}  
  {Auth::check()}
  <center><img src="{url('assets/img/profile')}/{$foto}" width="150" height="150"></center>
  <div class="well"> 
      <center><p>{$usuario->nombre}</p></center>
      <center><p>{$usuario->correo}</p></center>
  </div>
  
  <hr>
  
  <div class='row'>
    <center><h3>Amigos</h3></center>
   
      {foreach $amigos as $amigo}
        <div class='col-sm-4'>
          <a href='{url('profile/ver')}/{$amigo->id}' ><img width='70' height="70"  src='{url('/assets/img/profile')}/{$amigo->id}.jpg'></a>
          <p>{$amigo->nombre}</p>
          </div>
      {/foreach}
   </div> 
  
  {/capture}
{capture assign="right"}
  
   {Form::open(['url'=>'publicacion/crear'])}
   <textarea required name="publicacion" placeholder="¿Qué estás pensando?" rows="3" class="col-sm-12"></textarea>
   <input type='hidden' name='receptor' value='{$usuario->id}'> 
   
   <button type="submit" class="btn pull-right btn-success">Publicar</button>
  {Form::close()}
  <hr>
  <br>
  <br>
  <br>
     {foreach $publicaciones as $publicacion}
       <div class="well" style="word-break: break-all; margin-bottom: 5px; padding: 10px 5px; font-family: 'Noto Sans', sans-serif; ">
         <button class="close" aria-hidden="true" style="margin-top: -10px;"><a href="{url('publicacion/eliminar')}/{$publicacion->id}">&times;</a></button>
         <a href='{url('profile/ver/')}/{$publicacion->usuario_id}'>
           <img width='40' height="40" src="{url('assets/img/profile')}/{$publicacion->usuario_id}.jpg">
         </a>
         {$publicacion->publicacion}
       </div>
       <div>
         <span class="glyphicon glyphicon-comment"></span> <span>Comentar</span> |
         <span class="glyphicon glyphicon-thumbs-up"></span> <a><span id="t-me-gusta-{$publicacion->id}" style="cursor:pointer" onclick="fb.meGusta({$publicacion->id})"> {$publicacion->leGustaA(Auth::user()->id)}</span></a> |          
         <span class="glyphicon glyphicon-thumbs-up"></span> <span id="n-me-gusta-{$publicacion->id}">{Publicacion::likes($publicacion->id)}</span> personas les gusta esto 
         
         <div id="comentarios-{$publicacion->id}">
            {foreach $publicacion->comentarios() as $comentario}
                <div style="font-size: 10px; padding: 3px;" class="well well-sm col-sm-7"><img src="{url('assets/img/profile')}/{$foto}" width="30" height="30"> {$comentario->publicacion}</div>
            {/foreach}
         </div>
         
         <div style="clear:both"></div>
         
         <textarea id="comentario-{$publicacion->id}" rows="1" placeholder="Escribe tu comentario ... " class="col-sm-6"></textarea>
         <button class="btn btn-success btn-sm" onclick="fb.comentar({$publicacion->id})">Comentar</button>
         
         
       </div>
       <hr>
       {foreachelse}
         
         <div class="alert alert-danger">
            No hay publicaciones
         </div>
       
     {/foreach}
  
  {/capture}
{capture assign="portada"}
  
  <img src="http://comutricolor.com/wp-content/uploads/2013/10/seleccion-colombia.png">
  
  {/capture}
  
  {include file="../masterpage/template.tpl" layout="two_columns"}