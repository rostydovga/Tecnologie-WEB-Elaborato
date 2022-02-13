$(document).ready(function() {
    //$("#madonna").hide();
    $(":radio").on("change", function() {
        $.ajax({
            url: "fragrances.php",
            method: "POST",
            data: { "ordinamento": $("input[name=ordinamento]:checked").val()},
            success: function(response) {
                console.log(response);
            }
        });
        //$("#madonna").click();
        //$.post("fragrances.php", {"ordinamento" : $("input[name=ordinamento]:checked").val()});
        //location.reload();
    });

});