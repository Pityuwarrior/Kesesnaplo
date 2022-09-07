
<?php $ossztanulo = ossztanulo();
    $megjegyzes = megjegyzes();?>
<?php 
if(isset($_POST['send']))
{
$datum = $_POST['datum'];
$id = $_POST['id'];
$ig = $_POST['ig'];
$megj = $_POST['megj'];
$ujkeses = ujkeses($datum,$id,$ig,$megj);

echo("Új késés sikeresen felvéve <a href ='?p=reszlet&tanulo=".$ujkeses["id"]."'>".$ujkeses["nev"]."</a> tanulónak.");
}
else
{
?>
<div class="w3-container content"><h2>Új késés felvétele</h2>
    <form method='POST' action=''>
        <div>
            <label class='adat'>Dátum:</label>
            <input class='adat' type='date' name='datum' min='yyyy-09-01' max='yyyy-07-15' value='<?= date("Y-m-d") ?>'>
        </div>
        <div>
            <label class='adat'>Tanuló:</label>
            <select class='adat' name='id'>
                <?php foreach($ossztanulo as $tanulo): ?>
                <option value='<?= $tanulo['id']?>'><?= $tanulo['nev']?> (<?=$tanulo['onev']?>)</option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <label class='adat'>Igazolt:</label>
            <input type='radio' name='ig' value='1'>igen
            <input type='radio' name='ig' value='0' checked>nem
        </div>
        <div>
            <label class='adat'>Megjegyzés:</label>
            <select class='adat' name='megj'>
            <?php foreach($megjegyzes as $megj): ?>
                <option value='<?=$megj['id']?>'><?=$megj['megj']?></option>
                <?php endforeach ?>    
            </select>
        </div>
        <div>
            <label class='adat' ></label>
            <input type='submit' name='send' value='Felvétel'>
        </div>
    </form>
</div>
<?php
}