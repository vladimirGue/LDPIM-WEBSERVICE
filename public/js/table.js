
var J=jQuery.noConflict();
//button pour editer la tache selon l'id
J('[name=editer]').click(function(){
    event.preventDefault();
     var data=J(this).attr('id');
     var datos="id="+data;
    J.ajax({
        url:'http://localhost:8080/PRUEBA/controlleur/getId/',
        type:'post',
        data:datos,
    })
    .done(function(result){
        var obj=J.parseJSON(result);
        J('#date').val(obj['date']);
        J('#tache').val(obj['tache']);
        J('#id').val(obj['id']);
    })
    .fail(function(){
      J('#result').html("esto fallo");
    });
});

//button pour effacer la tache selon l'id
J('[name=effacer]').click(function(){
         event.preventDefault();
         var data=J(this).attr('id');
         var datos="id="+data;

         swal({
             title:"estas seguro de borrar?",
             text:"si lo borras no hay vuelta atras",
             icon:"warning",
             buttons:true,
             dangerMode:true,
         })
         .then((willDelete)=>{
             if(willDelete){
                J.ajax({
                    url:'http://localhost:8080/PRUEBA/controlleur/delete/',
                    type:'post',
                    data:datos,
                })
                .done(function(result){
                   J('#tabl').html(result);
                   swal("Poof! Your file has been deleted!", {
                    icon: "success",
                  });
                })
                .fail(function(){
                   J('#result').html("esto fallo");
                });
             }else{
                 swal("bien echo campeon");
             }
         });
         
});

//button pour affecter la tache selon l'id
J('[name=iduser]').click(function(){
    event.preventDefault();
    var data=J(this).attr("id-user");
    var dataTache=J(this).attr("id-tache");
    J.ajax({
        url:'http://localhost:8080/PRUEBA/controlleur/affecterTache/',
        type:'post',
        data:{"id-user":data,"id-tache":dataTache},
    })
    .done(function(){
        alert("affecté")
    });
});