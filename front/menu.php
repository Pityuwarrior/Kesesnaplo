<?php
$fajl = "./front/pages/kezdolap.php";
if(isset($_GET['p']))
{
    $p = $_GET['p'];
    if (!$belepve)
    {
        switch ($p)
        {
            case "login": {$fajl="./front/pages/login.php";break;}
            default: {$fajl="./front/pages/kezdolap.php";break;}
        }
    }
    else
    {
        switch ($p)
        {
            case "login": {$fajl="./front/pages/login.php";break;}
            case "tanulok": {$fajl="./front/pages/tanulok.php";break;}
            case "reszlet": {$fajl="./front/pages/reszlet.php";break;}
            case "ujkeses": {$fajl="./front/pages/ujkeses.php";break;}
            case "osztalyok": 
            case "osztaly": {$fajl="./front/pages/osztalyok.php";break;}
            case "modositas": {$fajl="./front/pages/modositas.php";break;}
            case "torles": {$fajl="./front/pages/torles.php";break;}
            default: {$fajl="./front/pages/kezdolap.php";break;}
        }
    }
}
?>