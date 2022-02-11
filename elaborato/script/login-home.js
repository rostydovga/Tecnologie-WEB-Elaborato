$(document).ready(function() {

    $("#logoutButton").click(function() {

        console.log("LogoutCliccato");
        confirmation = false;
        $.post("login.php", { "action": "logout" },
            function(response) {
                alert("Logout successfully");

            });
        console.log("FUori richiesta POST");

    })

});