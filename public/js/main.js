
var JQ=jQuery.noConflict();
JQ(document).ready(function(){
   JQ.ajax({
       url:'http://localhost:8080/PRUEBA/controlleur/getTodo',
   })
   .done(function(result){
      JQ('#tabl').html(result);
   })
   .fail(function(){
      $('#erreur').text("esto fallo");
   });

   JQ('#ajout').click(function (){
        event.preventDefault();
        var dataDate=JQ('#date').val();
        var dataTache=JQ('#tache').val();
        var valor = JQ('#chkveg').val();

    JQ.ajax({
       url:'http://localhost:8080/PRUEBA/controlleur/ajouter/',
       type:'post',
       data:{"id-date":dataDate,"tache":dataTache,"id-tacheUser":valor},
    })
    .done(function(result){
      JQ('#tabl').html(result);
      JQ('#date').val('');
      JQ('#tache').val('');
      JQ('#erreur').css('display','inline');
      JQ('#erreur').addClass('message');
      })
    .fail(function(){
        $('#erreur').text("esto fallo");
    });
    setTimeout(() => {
      JQ('#erreur').hide();
   },2000);
});

JQ('#modifier').click(function(){
     event.preventDefault();
     var data=JQ('#formPrin').serialize();

     JQ.ajax({
        url:'http://localhost:8080/PRUEBA/controlleur/update/',
        type:'post',
        data:data,
     })
     .done(function(result){
      JQ('#tabl').html(result);
      JQ('#date').val('');
      JQ('#tache').val('');
      JQ('#id').val('');
      JQ('#erreur').css('display','inline');
      JQ('#erreur').addClass('messageM');
      })
      .fail(function(){
         $('#erreur').text("esto fallo");
     });
     setTimeout(() => {
      JQ('#erreur').hide();
   },2000);
});

JQ('#ajouterUser').click(function(){
   event.preventDefault();
   var data=JQ('#formAjoutUser').serialize();

   JQ.ajax({
      url:'http://localhost:8080/PRUEBA/controlleur/ajouterUser/',
      type:'post',
      data:data,
   })
   .done(function(){
     JQ('#fait').css('display','inline');
     JQ('#fait').addClass('userajoute');
   });
   setTimeout(() => {
      JQ('#fait').hide();
   },2000);
});
//ici les checkbox

JQ('#chkveg').multiselect({
   includeSelectAllOption: true
});

});
