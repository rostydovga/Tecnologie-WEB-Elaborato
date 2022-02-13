$(document).ready(function() {

    $("#logoutButton").click(function() {
        $.ajax({
            type: "POST",
            url: "/elaborato/login.php",
            data: { action: "logout" },
            success: function(status) {
                $("#modalLogout").modal("show");
            }
        });
    });

});