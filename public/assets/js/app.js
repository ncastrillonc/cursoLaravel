
var fb = {
  
  
  meGusta : function(id){
     
      $.ajax({
        url: baseUrl + '/publicacion/me-gusta',
        type: 'POST',
        async: true,
        data: {
            publicacion : id            
        },
        success: function(response){
            console.log(response);
            $("#n-me-gusta-"+id).text(response.nlikes);
            $("#t-me-gusta-"+id).text(response.type==-1?"Me gusta" : "Ya no me gusta");
        }
      });    
    
  },  
  
  
  comentar: function(id) {
    var comentario = $("#comentario-" + id);
    if (comentario.val() != "") {

      $.ajax({
        url: baseUrl + '/publicacion/comentar',
        type: 'POST',
        async: true,
        data: {
            publicacion : id,
            comentario : comentario.val()
        },
        success: function(response){
            console.log();
            $("#comentarios-"+id).append("<div style='font-size: 10px; padding: 3px;' class='well well-sm col-sm-7'><img src='" + baseUrl + "/assets/img/profile/"+ response.usuario_id +".jpg' width='30' height='30'>"+ response.publicacion +"</div>");
            comentario.val("");
        }
      });


    } else {
      alert('Este campo es obligatorio');
    }
  }
};








