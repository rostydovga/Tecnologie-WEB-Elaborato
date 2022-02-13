<?php  
    require_once("../bootstrap.php");

    if(isset($_POST["action"])){
        logOutUser();
        $templateParams["isAdmin"] = 0;
    }

?>