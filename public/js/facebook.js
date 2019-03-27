var V=jQuery.noConflict();

V(document).ready(function(){
    V.ajax({
        url:'http://localhost:8080/PRUEBA/controlleur/userFacebook',
    })
    .done(function(result){
        V('#login').html(result);
    })
    .fail(function(){
    V('#fail').html("errur");
    });
});