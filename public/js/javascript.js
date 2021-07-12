$(document).ready(function(){
    $("#societe").click(function(){
        var url = $("#societe").attr("data-path");
        $.ajax({
           type: "post",
           url: url,
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
        var url = $("#dirigeant").attr("data-path");
        $.ajax({
           type: "post",
           url: url,
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
        var url = $("#addcode").attr("data-path");
        $('html,body').animate({scrollTop: $("#formulaire").offset().top}, 'slow'      );
        $.ajax({
           type: "post",
           url: url ,
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
        var url = $("#addville").attr("data-path");
        $('html,body').animate({scrollTop: $("#formulaire").offset().top}, 'slow'      );
        $.ajax({
           type: "post",
           url: url,
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
            url: url,
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
            url: url,
            success: function(response) {
                var editSociete = response;
                $("#formulaire").html(editSociete);
            }
        });
    })
 });

 $(document).on('change','#societe_codepostal', function(){
    var test = $("#societe_codepostal").val();
    url = "/societe/codeVille/"+test 
        $.ajax({
            type: "post",
            url: url,
            success: function(response) {
                var villes = response;
                $("#ville").removeClass("cacher");
                $("#societe_ville").html(villes);
            }
        });
    });

