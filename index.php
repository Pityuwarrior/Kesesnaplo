<?php
include("./back/db_function.php");
include("./back/session.php"); // session kezelés
//include("./back/functions.php");// függvények és eljárások
include("./front/menu.php"); // menükezelés
include("./front/header.php"); // fejrész
include($fajl);
include("./front/footer.php");// lábrész
?>