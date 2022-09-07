
<?php $modositas = modositas($_GET['modid']);
    $megjegyzes = megjegyzes();?>
<?php 
if(isset($_POST['send']))
{
$id = $_GET['modid'];
$ig = $_POST['ig'];
$megj = $_POST['megj'];
$modositas2 = modositas2($id,$ig,$megj);
header("Location: ./?p=reszlet&tanulo=".$modositas["id"]);
exit;
}
else
{
?>
<div class="w3-container content"><h2>Késés módosítása</h2>
<form method='POST' action=''>
	<div>
		<span class='adat'>Tanuló:</span>
		<span class='adat'><?= $modositas["nev"]?></span>
	</div>
	<div>
		<span class='adat'>Dátum:</span>
		<span class='adat'><?= $modositas["datum"]?></span>
	</div>
	<div>
		<label class='adat'>Igazolt:</label>
		<span class='adat'>
        <input type='radio' name='ig' value='1' <?= $modositas["igazolt"]==='1' ? "checked" : ""?>> igen
		<input type='radio' name='ig' value='0' <?= $modositas["igazolt"]==='0' ? "checked" : ""?>> nem
		</span>
	</div>
	<div>
    <label class='adat'>Megjegyzés:</label>
            <select class='adat' name='megj'>
            <?php foreach($megjegyzes as $megj): ?>
                <option value='<?=$megj['id']?>' <?= $modositas["megjid"]===$megj['id'] ? "selected" : ""?>><?=$megj['megj']?></option>
                <?php endforeach ?>    
            </select>
	</div>
	<div>
		<label class='adat' ></label>
		<input type='submit' name='send' value='Módosítás'>
		<a href='./?p=reszlet&tanulo=<?= $modositas["id"]?>'>Mégsem</a>
	</div>
</form>
</div>
<?php
}