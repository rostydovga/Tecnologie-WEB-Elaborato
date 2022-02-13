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
    },
    function() {
        var hr_card = $(this).find("hr");
        $(hr_card).css({
            "width": "25%",
            "opacity": "0.3"
        });
        var img_card = $(this).find("img");
    });

    $(".offcanvas .offcanvas-body .card input").on("change", function() {
        $.ajax({
            method: "POST",
            url: "/elaborato/script/api-cart.php",
            data: {
                QuantNelCarrello: $(this).val(),
                IdProdotto: $(this).parentsUntil(".card-body").find(".d-none").text()
            }
        });
    });

});
