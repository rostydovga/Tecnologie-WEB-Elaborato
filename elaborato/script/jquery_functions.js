$(document).ready(function() {
    
    //Eliminazione elemento del carrello quando quantity = 0
    $(".offcanvas .offcanvas-body .card input").click(function() {
        var qty = $(this).val();
        //trovo la .card
        var card_items = $(this).parentsUntil(".offcanvas-body");
        var divisor = card_items.nextUntil(".card");

        if(qty < 1) {
            $(card_items).fadeOut("slow","swing");
            $(divisor).fadeOut("slow","swing");
        }

    });

    $("[type='number']").keydown(function(evt) {
        evt.preventDefault();
    });


    /*modifica hr con passaggio del mouse per i prodotti*/
    $("section.product .card").hover(function() {
        var hr_card = $(this).find("hr");
        $(hr_card).css({
            "width": "75%",
            "opacity":"0.5"
        });
        
        var img_card = $(this).find("img");
        /*$(img_card).animate({
            width : "+=5%",
            height : "+=5%"
        });*/


      },
      function() {
        var hr_card = $(this).find("hr");
        $(hr_card).css({
            "width": "25%",
            "opacity": "0.3"
        });

        var img_card = $(this).find("img");
        /*$(img_card).animate({
            width : "-=5%",
            height : "-=5%"
        });*/
      });


      /*Fragrance.html*/
      //Se vien scelto il checkbox della candela non permettere il click sui check Gender
    /*
      $("aside section #candela").click(function(){
        console.log("Click check");
        gestisi_Gender($(this).prop("checked"));
    });

    function gestisi_Gender(manage){
        $("aside section #uomo,#donna,#unisex").prop("checked",manage);
        $("aside section #uomo,#donna,#unisex").attr("disabled", manage);
    }
    */

    /*$(".offcanvas .offcanvas-body .card input").on("change", function() {
        $.ajax({
            method: "POST",
            data: {
                QuantNelCarrello: $(this).val()
            },
            success: alert("ciaa")
        });

    });*/

});
