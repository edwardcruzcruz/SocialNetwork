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
});