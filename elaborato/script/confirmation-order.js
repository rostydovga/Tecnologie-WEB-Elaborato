$(document).ready(function() {

    //se tutti i campi della carta di credito non sono compilati non attivo il bottone
    //$("#confirmPaymentButton").attr("disabled", "disabled");
    //devo prendere tutti gli input della carta
    $('#credit-card input').keypress(function() {

        valori = $(this);
        //console.log(valori);
        console.log(valori[0].val());


        /*    for (let i = 0; i < valori.length; i++) {
            console.log(valori[i]);
        }*/

        $("#confirmPaymentButton").attr("disabled", function() {

            return false;
        });

    });

    /*
        function my_function() {
            valori = $('#credit-card input[type="text"]');
            console.log(valori.empty);

        }*/



});