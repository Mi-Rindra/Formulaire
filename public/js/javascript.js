$(document).ready(function(){
    $("#societe").click(function(){
        $.ajax({
           type: "post",
           url: "http://localhost:8005/societe/ajout",
           success: function(response) {
               var formulaire = response;
               console.log(formulaire);
               $("#formulaire").html(formulaire);
           
           }
       });
    })
})

$(document).ready(function(){
    $("#dirigeant").click(function(){
        $.ajax({
           type: "post",
           url: "http://localhost:8005/dirigeant/ajout",
           success: function(response) {
               var formulaire = response;
               console.log(formulaire);
               $("#formulaire").html(formulaire);
           
           }
       });
    })
})

$(document).ready(function(){
    $("#addcode").click(function(){
        $('html,body').animate({scrollTop: $("#formulaire").offset().top}, 'slow'      );
        $.ajax({
           type: "post",
           url: "http://localhost:8005/codepostal/ajout",
           success: function(response) {
               var formulaire = response;
               console.log(formulaire);
               $("#formulaire").html(formulaire);
           
           }
       });
    })
})

$(document).ready(function(){
    $("#addville").click(function(){
        $('html,body').animate({scrollTop: $("#formulaire").offset().top}, 'slow'      );
        $.ajax({
           type: "post",
           url: "http://localhost:8005/ville/ajout",
           success: function(response) {
               var formulaire = response;
               console.log(formulaire);
               $("#formulaire").html(formulaire);
           
           }
       });
    })
})

$(document).ready(function(){
    $(".editDirigeant").click(function(event){
        event.preventDefault();
        var idDirigeant = $(this).attr("id");
        var url= $("#"+idDirigeant).attr("href");
        $('html,body').animate({scrollTop: $("#formulaire").offset().top}, 'slow'      );
        $.ajax({
            type: "post",
            url: "http://localhost:8005"+url,
            success: function(response) {
                var editDirigeant = response;
                $("#formulaire").html(editDirigeant);
            }
        });
    })
 });

 $(document).ready(function(){
    $(".editSociete").click(function(event){
        event.preventDefault();
        var idSociete = $(this).attr("id");
        var url= $("#"+idSociete).attr("href");
        $('html,body').animate({scrollTop: $("#formulaire").offset().top}, 'slow'      );
        $.ajax({
            type: "post",
            url: "http://localhost:8005"+url,
            success: function(response) {
                var editSociete = response;
                $("#formulaire").html(editSociete);
            }
        });
    })
 });
