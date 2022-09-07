<?php
session_start();
if (isset($_SESSION['id']))
{
    $belepve=true;
    $nev = $_SESSION['id'];
	$userinfo = userinfo();
}
else
{
    $belepve=false;
}
if (isset($_GET["logout"]) && $_GET["logout"]=="yes") 
{ 
	session_unset(); 
	session_destroy(); 
	header('Location: ./');
}

?>