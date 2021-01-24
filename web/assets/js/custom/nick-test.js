$(document).ready(function(){
    //capturamos el objeto con el nombre de la clase nick-input y con el metodo blur
    //accionamos un proceso cada vez que el usuario deja de tipear y sale del campo
    //nick-input
   $(".nick-input").blur(function(){
       //obtenemos el nick justo despues de que el usuario quite el curso del campo
       var nick = this.value;
       $.ajax({
           //cuidado con solo agregar nick-test como path, se debe colocar el path aabsoluto
           url: URL+"/nick-test",
           data: {nick: nick},
           type: 'POST',
           success: function(response){
               if(response=="used"){
                   $(".nick-input").css("border","1px solid red");
                }else{
                   $(".nick-input").css("border","1px solid green"); 
                }
           }
       });
   });
});

