$(document).ready(function(){

    $("#addCartButton").click(function() {
        console.log("ciao");
        
        $.ajax({
            type: "GET",
            data: "nome=figa$cognome=cavallini"
        });

    });

});