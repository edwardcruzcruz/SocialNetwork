//verificar si funciona nuestro customer js
$(document).ready(function(){
   //alert("USERS");
   
   //cargamos el objeto de tipo ias para nuestra carga dinamica de scroll infinito 
   //Parametros como el contenedor de nuestros usuarios .box-users
   //Cada usuario .user-item
   //Contenedor de la paginacion .pagination
   //Con next cargamos la siguiente pagina que hay en nuestro selector
   //Con triggerPageThreshold  indica
   //cada cuanto elementos se lanza la peticion ajax para  la siguiente pagina
   var ias = jQuery.ias({
       container: '.box-users',
       item: '.user-item',
       pagination: '.pagination',
       next: '.pagination .next_link',
       triggerPageThreshold: 5
   });
   //boton para cuando se muestran n (offset) paginas seguidas un boton que indique 
   //si quiere seguir viendo mas contenido
   ias.extension(new IASTriggerExtension({
       text: 'Ver más',
       offset: 3
   }));
   //loader gif de cargando tipico de las paginas web
   ias.extension(new IASSpinnerExtension({
       src: URL+'/../assets/images/ajax-loader.gif'
   }));
   //cuando ya no hay registros que mostrar se cargara el mensaje...
   ias.extension(new IASNoneLeftExtension({
       text: 'No  hay más personas'
   }));
   //cuando se carga la pagina por primera vez
   ias.on('ready', function(event){
       followButtons();
   });
   //cuando renderizamos la parte restante del listado de usuarios por scroll
   ias.on('rendered', function(event){
       followButtons();
   });
});

function followButtons(){
    //usamos una funcion puesto a que es mas facil y praactico usarla y llamarla 
    //desde  cualquier parte
    
    //el btn-follow es la clase inpuesta al boton de seguir en users.html, y con 
    //el metodo unbind('click') evitamos que se carguen mas peticiones en mas de un
    //click a seguir
    $(".btn-follow").unbind("click").click(function(){
        //la peticion ajax sirve para manejar las solicitudes http de un form o un boton
        //en data obtenemos el ocntenido data-followed del boton y con success creamos
        //una funcion que lo muestr por consola
        $(this).addClass("hidden");
        $(this).parent().find('.btn-unfollow').removeClass('hidden');
        $.ajax({
           url: URL+'/follow',
           type: 'POST',
           data: { followed: $(this).attr("data-followed")},
           success: function(response){
               console.log(response);
           }
        });
    });
    
    $(".btn-unfollow").unbind("click").click(function(){
        //la peticion ajax sirve para manejar las solicitudes http de un form o un boton
        //en data obtenemos el ocntenido data-followed del boton y con success creamos
        //una funcion que lo muestr por consola     
        $(this).addClass("hidden");
        $(this).parent().find('.btn-follow').removeClass('hidden');
        $.ajax({
           url: URL+'/unfollow',
           type: 'POST',
           data: { followed: $(this).attr("data-followed")},
           success: function(response){
               console.log(response);
           }
        });
    });
}