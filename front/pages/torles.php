<?php $torles = torles($_GET['delid']);
    $megjegyzes = megjegyzes();?>
<?php 
if(isset($_POST['send']))
{
$id = $_GET['delid'];
$torles2 = torles2($id);
header("Location: ./?p=reszlet&tanulo=".$torles["id"]);
exit;
}
else
{
?>
<div class="w3-container content"><h2>Késés törlése</h2>
<form method='POST' action=''>
	<div>
		<span class='adat'>Tanuló:</span>
		<span class='adat'><?= $torles["nev"]?></span>
	</div>
	<div>
		<span class='adat'>Dátum:</span>
		<span class='adat'><?= $torles["datum"]?></span>
	</div>
	<div>
		<label class='adat'>Igazolt:</label>
		<span class='adat'><?= $torles["igazolt"]==='1' ? "igen" : "Nem"?></span>
	</div>
	<div>
		<label class='adat'>Megjegyzés:</label>
		<span class='adat'><?=$torles["megj"]?></span>
	</div>
	<div>
		<label class='adat hiba' >Biztosan törlöd?</label>
		<input type='submit' name='send' value='Törlés'>
		<a href='./?p=reszlet&tanulo=<?= $torles["id"]?>'>Mégsem</a>
	</div>
</form>
</div>
<?php
}