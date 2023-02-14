<?php include("template/modules/header.php"); ?>

    <?php

    if ($act == "") {$act = "mainpage";}

    switch ($act) {
        case "mainpage":
            include("template/pages/main.php");
            break;
        case "spa":
            include("template/pages/service.php");
            break;
        case "massage":
            include("template/pages/service.php");
            break;
        case "testing":
            include("template/pages/testing.php");
            break;
        case "login":
            if (userLoggedIn()) {header("Location: /");} else {include("template/pages/login.php");}
            break;
        case "signup":
            if (userLoggedIn()) {header("Location: /");} else {include("template/pages/signup.php");}
            break;
        case "profile":
            if (!userLoggedIn()) {header("Location: /");} else {include("template/pages/profile.php");}
            break;
        default:
            $result = $db->query("select * from `static` where `name`='$act' limit 1");
            if ($result->num_rows>0) {
                $page = $result->fetch_assoc();
                include("template/pages/static.php");
            } else {
                include("template/pages/404.php");
            }
            break;
    }
    ?>

<?php include("template/modules/footer.php"); ?>