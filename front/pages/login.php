<?php
if($belepve)
{
    header('Location: ./');
}
if(isset($_POST['send'])) 
{   
    $userid = Jelszo($_POST['nev'],$_POST['pw']);
    if($userid)
    {    
        $_SESSION['id'] = $userid;
        header('Location: ./');
    }
    else
    {
        echo "Sikertelen belépés!";
    }
}
?>
<div class="w3-container content"><h2>Belépés</h2>
    <form method='POST' action=''>
    <div>
        <label class='adat'>Felhasználó név:</label>
        <input type='text' name='nev' required>
    </div>
    <div>
        <label class='adat'>Jelszó:</label>
        <input type='password' name='pw' required>
    </div>
        <label class='adat' ></label>
        <input type='submit' name='send' value='Belépés'>
    </form>
</div>